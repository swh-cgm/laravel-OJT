<?php
namespace App\Services;

use App\Contracts\Dao\UserDaoInterface;
use App\Contracts\Services\AdminServiceInterface;
use App\Exports\CommentsExport;
use App\Exports\PostsExport;
use App\Http\Requests\AdminPasswordStoreRequest;
use App\Http\Requests\CsvUploadRequest;
use App\Imports\PostsImport;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;



class AdminService implements AdminServiceInterface
{
    protected $userDao;

    public function __construct(UserDaoInterface $userDao)
    {
        $this->userDao = $userDao;
    }
    /**
     * Store changed password by Admin
     *
     * @param string $password
     * @param integer $id
     * @return void
     */
    public function storeChangePassword(string $password, int $id): void
    {
        $this->userDao->storeChangedPassword($password, $id);
    }

    /**
     * Store changed user data by Admin
     *
     * @param AdminPasswordStoreRequest $request
     * @return void
     */
    public function updateUser(AdminPasswordStoreRequest $request): void
    {
        if ($request->img) {
            $filename = $request->img->getClientOriginalName();
            $request->img->storeAs('UserImages', $filename, 'public');
        } else {
            $filename = User::where('id', $request->id)->value('img');
        }

        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->has('role') ? $request->role : config('constants.user_role.member_no'),
            'img' => $filename,
            'created_by' => 1
        ];
        $this->userDao->update($updateData, $request->id);
    }

    public function postCsvDownload(){
        return Excel::download(new PostsExport, 'posts_'.time().'.csv');
    }

    public function postCsvUpload(CsvUploadRequest $request){
        $import = new PostsImport();
        $import->import($request->file('posts_csv'));
        $failures = $import->failures();

        return $failures;
    }
}

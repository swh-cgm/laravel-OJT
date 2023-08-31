<?php
namespace App\Contracts\Services;

use App\Http\Requests\AdminPasswordStoreRequest;
use App\Http\Requests\CsvUploadRequest;

interface AdminServiceInterface
{
    public function storeChangePassword(string $password, int $id);

    public function updateUser(AdminPasswordStoreRequest $request);

    public function postCsvDownload();

    public function postCsvUpload(CsvUploadRequest $request);
}

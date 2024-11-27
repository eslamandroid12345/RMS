<?php

namespace App\Http\Controllers\Api\Attachment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Attachment\AttachmentRequest;
use App\Http\Services\Api\Attachment\AttachmentService;
use App\Repository\AttachmentRepositoryInterface;
use Illuminate\Http\Request;

class AttachmentController extends Controller
{
    private  $attachmentService;
    public function __construct(AttachmentService $attachmentService)
    {
        $this->attachmentService=$attachmentService;
    }

    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        return 'heda';
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AttachmentRequest $request)
    {
        return $this->attachmentService->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->attachmentService->show($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update( AttachmentRequest $request)
    {
        return $this->attachmentService->update($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->attachmentService->destroy($id);
    }
}

<?php

namespace Qwikkar\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Qwikkar\Http\Controllers\Controller;

class UploadController extends Controller
{
    /**
     * Upload types for application
     */
    protected $types = ['image', 'document'];

    /**
     * UploadController constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->middleware('not-admin');

        if (!in_array($request->type, $this->types)) abort(Response::HTTP_NOT_FOUND);
    }

    /**
     * Invoke uploading images or documents
     *
     * @param Request $request
     * @param $type
     * @return string
     */
    public function __invoke(Request $request, $type)
    {
        $path = '';
        switch ($type) {
            case 'image':
                $path = $this->uploadImage($request);
                break;
            case 'document':
                $path = $this->uploadDocument($request);
                break;
        }

        return api_response(asset("storage/{$path}"));
    }

    /**
     * Upload images and return hash
     *
     * @param Request $request
     * @return string
     */
    protected function uploadImage(Request $request)
    {
        $this->validate($request, [
            'upload' => 'required|image'
        ]);

        return $request->upload->store('images', 'public');
    }

    /**
     * Upload documents and return hash
     *
     * @param Request $request
     * @return string
     */
    protected function uploadDocument(Request $request)
    {
        $this->validate($request, [
            'upload' => 'required|file'
        ]);

        return $request->upload->store('document', 'public');
    }
}

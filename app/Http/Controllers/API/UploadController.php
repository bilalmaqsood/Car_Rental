<?php

namespace Qwikkar\Http\Controllers\API;

use Illuminate\Http\Request;
use Qwikkar\Http\Controllers\Controller;

class UploadController extends Controller
{
    /**
     * upload types for application
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

        if (!in_array($request->type, $this->types)) abort(404);
    }

    /**
     * Invoke uploading images or documents
     *
     * @param Request $request
     * @param $type
     * @return array
     */
    public function __invoke(Request $request, $type)
    {
        switch ($type) {
            case 'image':
                $this->uploadImage($request);
                break;
            case 'document':
                $this->uploadDocument($request);
                break;
        }

        return abort(404);
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

        return asset($request->upload->store('images'));
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

        return asset($request->upload->store('document'));
    }
}

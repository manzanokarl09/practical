<?php

namespace App\Http\Controllers\V1;

use App\Http\Requests\IndexRequest;
use App\Http\Requests\SampleRequest;
use App\Repositories\Rest\RestRepository;
use App\Sample;
use Illuminate\Http\Request;

class SampleController extends BaseController {

    /**
     * @var RestRepository
     */
    private $rest;

    public function __construct(Sample $rest) {

        $this->rest = new RestRepository($rest);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexRequest $request) {
        //
        $data = $request->all();

        $callback = function () use ($data) {
            $response = $this->rest->getModel();

            $response = json_decode($data['paginate']) ? $response->paginate($data['per_page']) : $response->get();

            return listResponse($response);
        };

        return $this->exceptionHandler($callback);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(SampleRequest $request) {
        //

        $data = $request->all();

        $callback = function () use ($data) {

            $response = $this->rest->create($data);

            return createdResponse($response);
        };

        return $this->exceptionHandler($callback);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //


        $callback = function () use ($id) {

            if ($response = $this->rest->find($id)) {
                return showResponse($response);
            }

            return notFoundResponse();
        };

        return $this->exceptionHandler($callback);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(SampleRequest $request, $id) {
        //
        $data = $request->all();

        $callback = function () use ($data, $id) {

            if ($response = $this->rest->find($id)) {

                $response->fill($data)->save();

                return showResponse($response);
            }

            return notFoundResponse();
        };

        return $this->exceptionHandler($callback);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
        $callback = function () use ($id) {

            if ($response = $this->rest->find($id)) {

                $response->delete();

                return deletedResponse();
            }

            return notFoundResponse();
        };

        return $this->exceptionHandler($callback);

    }

 
}

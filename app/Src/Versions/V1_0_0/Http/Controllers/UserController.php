<?php

namespace Api\V1_0_0\Http\Controllers;

use App\Http\Controllers\Controller;
use Api\V1_0_0\Repositories\User\UserInterface;
use Api\V1_0_0\Http\Requests\UserRequest;
class UserController extends Controller
{
    /**
     * @var \Api\V1_0_0\Repositories\User\UserInterface $user
     */
    private $user;

    /**
     * Create new instance
     * @param \Api\V1_0_0\Repositories\User\UserInterface $user
     */
    public function __construct(UserInterface $user)
    {
        $this->middleware('auth:api', ['except' => []]);
        $this->user = $user;
    }
    /**
     * Display a listing of the resource.
     * @param \Api\V1_0_0\Requests\UserRequest
     * @return \Illuminate\Http\Response
     */
    public function get(UserRequest $request)
    {
        $data = $this->user->get();

        $message = "List of users";

        return $this->response($message, $data);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Api\V1_0_0\Requests\UserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $data = $request->all();

        $response = $this->user->create($data);

        $message = "User successfully created.";

        return $this->response($message, $response);
        
    }

    /**
     * Display the specified resource.
     * @param \Api\V1_0_0\Requests\UserRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(UserRequest  $request, int $id)
    {

        $response = $this->user->find($id);

        $message = "User details.";

        return $this->response($message, $response);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Api\V1_0_0\Requests\UserRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, int $id)
    {
        $data = $request->except(["password"]);

        $response = $this->user->update($id, $data);
        
        $message = "Successfully updated.";

        return $this->response($message, $response);
    }

    /**
     * Remove the specified resource from storage.
     * @param \Api\V1_0_0\Requests\UserRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(UserRequest  $request, int $id)
    {
        $this->user->delete($id);

        $message = "Account deleted.";

        return $this->response($message,[]);
    }
}

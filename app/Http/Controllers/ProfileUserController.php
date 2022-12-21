<?php

namespace App\Http\Controllers;

use App\Models\profile_user;
use App\Http\Requests\Storeprofile_userRequest;
use App\Http\Requests\Updateprofile_userRequest;

class ProfileUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Storeprofile_userRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storeprofile_userRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\profile_user  $profile_user
     * @return \Illuminate\Http\Response
     */
    public function show(profile_user $profile_user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\profile_user  $profile_user
     * @return \Illuminate\Http\Response
     */
    public function edit(profile_user $profile_user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updateprofile_userRequest  $request
     * @param  \App\Models\profile_user  $profile_user
     * @return \Illuminate\Http\Response
     */
    public function update(Updateprofile_userRequest $request, profile_user $profile_user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\profile_user  $profile_user
     * @return \Illuminate\Http\Response
     */
    public function destroy(profile_user $profile_user)
    {
        //
    }
}

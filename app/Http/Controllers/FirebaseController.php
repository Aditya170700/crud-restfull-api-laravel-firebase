<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Database;

class FirebaseController extends Controller
{
	public function __construct(Database $database)
    {
    	// definisikan tabel
        $this->tabel_posts = $database->getReference('posts');
    }

	public function index()
	{
        $getAll = $this->tabel_posts->getValue();

        return response()->json($getAll);
    }

    public function create(Request $request)
    {
    	$request->validate([
    		'title' => 'required',
    		'body'  => 'required',
    	]);

        $createPost = $this->tabel_posts
				      ->push([
				        'title' =>  $request->title,
				        'body'  =>  $request->body,
				      ]);

		$message    = [
						'status'  => '200',
						'message' => 'Data created successfully!',
						'id'      => $createPost->getKey(),
						'data'    => $createPost->getValue(),
					];

        return $message;
    }

	public function update(Request $request, $id)
	{
        $updateData = [
	        			'title' => $request->title,
	        			'body'  => $request->body,
        			  ];

        $updates    = [
        				$id => $updateData,
        			  ];

        $updatePost = $this->tabel_posts->update($updates);

		$message    = [
						'status'  => '200',
						'message' => 'Data updated successfully!',
						'id'      => $id,
						'data'    => $updateData,
					];

        return $message;
    }

    public function show($id)
    {
    	$show = $this->tabel_posts
    			->orderByKey()
    			->equalTo($id)
    			->getValue();

    	return response()->json($show);
    }

    public function delete($id)
    {
    	$this->tabel_posts
    	->getChild($id)
    	->remove();

		$message = [
					'status' => '200',
					'message' => 'Data with id ' . $id . ' have been deleted!',
				];

		return $message;
    }
}

<?php

namespace App\Repositories;

use App\Models\Plots\PlotLocation;
use App\Retails\Retail;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Kreait\Firebase\Factory;
use Illuminate\Support\Str;

class FirebaseRepository
{

    protected $factory = null;
    protected $account = null;
    public function __construct($account = null)
    {
        $this->factory = (new Factory())
            ->withServiceAccount(base_path(env('FIREBASE_CREDENTIALS')))
            ->withDatabaseUri(env('FIREBASE_DATABASE_URL'));
        $this->account = $account;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     * allow write: if "auth.token.email === 'kiplangatsang425@gmail.com'";
     *
     */

    public function store($user, $folder, $file)
    {
        //
        try {
            $storage = app('firebase.storage'); // This is an instance of Google\Cloud\Storage\StorageClient from kreait/firebase-php library
            $defaultBucket = $storage->getBucket();
            $image = $file;
            $name = (string) Str::uuid() . "." . $image->getClientOriginalExtension(); // use Illuminate\Support\Str;

            $pathName = $image->getPathName();

            $package =  $this->firebaseRepositories($this->account, $user);
            $filename = $package . $folder . "/" . $name;
            // $file = fopen($pathName, 'r');
            $file = fopen($pathName, 'r');
            $object = $defaultBucket->upload($file, [
                'name' => $filename,
                'predefinedAcl' => 'publicRead'
            ]);
            $image_url = 'https://storage.googleapis.com/' . env('FIREBASE_PROJECT_ID') . '.appspot.com/' .  $filename;
            //dd($file);

            //https://storage.googleapis.com/dukaverse-e4f47.appspot.com/1/bf8af7e2-275d-4327-93a5-144fe2f42e24
            return $image_url;
        } catch (Exception $e) {
            Log::debug($e->getMessage());
            return $e->getMessage();
        }
    }

    public function firebaseRepositories(PlotLocation $plot = null, User $user)
    {
        # code...
        $package = "";
        if ($user->role == 0) {
            $package = "admin/" . $user->id . "/";
        } elseif ($user->role == 2) {
            $package = "landlord/" . $plot->id . $user->id . "/";
        } elseif ($user->role == 1) {
            $package = "tenant/" . $user->id . "/";
        } elseif ($user->role == 3) {
            $package = "caretaker/" . $plot->id . $user->id . "/";
        }
        return $package;
    }
}

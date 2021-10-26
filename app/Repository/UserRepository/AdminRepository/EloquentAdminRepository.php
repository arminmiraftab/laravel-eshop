<?php


namespace App\Repository\UserRepository\AdminRepository;


use App\admins;
use App\Helper\Helper;
use App\Http\Controllers\Product;
use App\image;
use App\Model\manufactures;
use App\products;
//use App\Model\products;
use App\role_user;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Repository\baseEloquent;


/**
 * Created by PhpStorm.
 * User: Asus
 * Date: 14.08.2021
 * Time: 19:15
 */
class EloquentAdminRepository implements AdminRepositoryInterface
{
    use baseEloquent;

    protected $model;

    public function __construct(admins $model)
    {
        $this->model = $model;
    }


    public function test()
    {
        return 'ok';
    }


    public function find($id)
    {
        $find = $this->model::where('id', $id)->first();
        return Helper::Result_exist($find);
    }

    public function update($id, $Request)
    {
        $flight = admins::find($Request->id);
        $flight->name = $Request->name;
        $flight->email = $Request->email;
        $flight->password = Hash::make($Request->password);
        $flight->roll_id = $Request->rule_id;
        $save=$flight->save();
        return Helper::Result_exist($save);

    }

    public function delete($id): bool
    {
       $delete= $this->model::where('id', $id)->delete();
        return Helper::Result_exist($delete);
    }

    public function Roll_Edite($id)
    {
        $Roll = $this->model::with(['roll'])->OfId($id)->first();
        return Helper::Result_exist($Roll);

    }

    public function exists($user_id, $role_id)
    {
        $exists = $this->model::where('roll_id', $role_id)->where('id', $user_id)->exists();
        return Helper::Result_exist($exists);
    }

     public function Roll_store($Request,$roll)
        {


            $this->model::create([
                'name' => $Request['name'],
//            'last_name' => $data['last_name'],
                'email' => $Request['email'],
                'roll_id' =>$roll ,
                'is_super' =>'1',
                'password' =>$Request['password']
            ]);
        return true;
        }


}
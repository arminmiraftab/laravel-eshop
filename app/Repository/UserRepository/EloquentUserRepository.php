<?php


namespace App\Repository\UserRepository;


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
class EloquentUserRepository implements UserRtepositoryInterface
{
    use baseEloquent;

    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }


    public function show()
    {
        $product = $this->model::active()->get();
        return $product;
    }

    public function test()
    {
        return 'ok';
    }
    public function find($id)
    {

        $find=$this->model::where('id', $id)->first();
//        return  ($find)?  $find: false;
        return  Helper::Result_exist($find);

    }

    public function update_Column($id, $Column, $chenge)
    {

        $update=  $this->model::where('id', $id)->update([$Column => $chenge]);

        return Helper::Result_bool($update);
    }



    public function update($request, $id)
    {

        $data = array();
        $data['email'] = $request->email;
        $data['name'] = $request->first_name;
        $data['phone_number'] = $request->mobail;
        $data['last_name'] = $request->last_name;
        $data['National_Code'] = $request->Code_nmber;

        $update= $this->model::where('id', $id)->update($data);
//        abort_if(!$update, 404);
        return Helper::Result_bool($update);
    }

    public function update_admin($id, $Request)
    {
        $flight = $this->model::find($Request->id);
        $flight->name = $Request->name;
        $flight->last_name = $Request->last_name;
        $flight->phone_number = $Request->phone;
        $flight->National_Code = $Request->user_nid;
        $flight->email = $Request->email;
        $flight->password = Hash::make($Request->password);
//        $flight->roll_id = $Request->rule_id;

        $update=$flight->save();
        return Helper::Result_bool($update);


    }


    public function delete($id): bool
    {
        $delete=$this->model::where('id', $id)->delete();
        return Helper::Result_bool($delete);
    }

    public function delete_admin($id): bool
    {
        $delete=admins::where('id', $id)->delete();
        return Helper::Result_bool($delete);    }

    public function count(): int
    {
        return $this->model::count();
    }

    public function user_select()
    {
         $select=$this->model::select('id', 'name', 'last_name')->get();

        return Helper::Result_exist($select);

    }

    public function Roll_Fetch()
    {
        $User = $this->model::with(['roll'])->
        orderBy('users.id', 'DESC')->get();
        return Helper::Result_exist($User);

    }

    public function Roll_admin_Fetch()
    {
        $User = admins::with(['roll'])->
        orderBy('id', 'DESC')->get();
        return Helper::Result_exist($User);

    }

    public function Roll_Find($id)
    {
        $User = $this->model::OfId($id)->first();
        return Helper::Result_exist($User);

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

    public function Update_Roll($user_id, $role_id){

            $exists = $this->update_Column($user_id, 'roll_id', $role_id);
            return Helper::Result_bool($exists);
    }
    public function Roll_store($Request)
    {
        $save= $this->model::create([
            'name' => $Request['name'],
            'last_name' => $Request['last_name'],
            'email' => $Request['email'],
            'password' =>$Request['password']
        ]);
        return Helper::Result_bool($save);
    }



}
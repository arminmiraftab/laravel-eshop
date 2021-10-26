<?php



namespace App\Repository\ViewRepository;



use App\admins;
use App\Http\Controllers\Product;
use App\image;
use App\Model\manufactures;
use App\model\View;
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

class EloquentViewRepository implements ViewRepositoryInterface
{
    use baseEloquent;

        protected $model;
        public function __construct(View $model)
    {
    $this->model = $model;
    }

    public function Percentage($type,$all){

        return $type != 0?  $type / $all * 100: $browseres = 0;


    }
        public function Percentage_browser($type):int {
         $browser=$this->model::where('browser',$type)->count();
            $allbrowser = view::all()->count();

            return $this->Percentage($browser,$allbrowser);
        }
        public function Percentage_platform($type) {
         $browser=$this->model::where('platform',$type)->count();
            $allbrowser = view::all()->count();
            return $this->Percentage($browser,$allbrowser);
        }

        public function find($id){
            $find=User::where('id',$id)->first();
            return $find;
        }

        public function update_Column($id,$Column,$chenge){

             User::where('id',$id)->update([$Column => $chenge]);

            return true;
        }
        public function update($request,$id){
         $data=array();
            $data['email']=$request->email;
            $data['name']=$request->first_name;
            $data['phone_number']=$request->mobail;
            $data['last_name']=$request->last_name;
            $data['National_Code']=$request->Code_nmber;
            $this->model::where('id',$id)->update($data);
            return true;
    }

    public function update_admin($id,$Request){
        $flight = User::find($Request->id);
        $flight->name = $Request->name;
        $flight->last_name = $Request->last_name;
        $flight->phone_number = $Request->phone;
        $flight->National_Code = $Request->user_nid;
        $flight->email = $Request->email;
        $flight->password = Hash::make($Request->password);
        $flight->roll_id =$Request->rule_id ;
        $flight->save();
    }



    public function delete($id):bool
    {
        $this->model::where('id',$id)->delete();
        return true;
    }

    public function count():int
    {
        return $this->model::count();
    }
    public function user_select(){
       return User::select('id','name','last_name')->get();

    }
     public function Roll_Fetch(){
        $User =User::with(['roll'])->
         orderBy('users.id', 'DESC')->get();
         return $User;

    }
    public function Roll_Find($id){
            $User =User::OfId($id)->first();
         return $User;

    }

     public function Roll_Edite($id){
             $Roll=User::with(['roll'])->OfId($id)->first();
             return $Roll;

        }
    public function exists($user_id,$role_id){
        $exists = User::where('roll_id', $role_id)->where('id', $user_id)->exists();
        return $exists;
    }

     public function Update_Roll($user_id,$role_id){
            $exists =$this->update_Column($user_id,'roll_id',$role_id);
            return true;

        }




}
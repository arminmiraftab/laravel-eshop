<?php

namespace App\Http\Controllers;


use App\category_maunfactur;
use App\categorys;
use App\Helper\Helper;
use App\Http\Requests\IdRequest;
use App\Http\Requests\ManufactureRequest;
use App\Http\Resources\brandServisResource;
use App\Http\Resources\CategoryMaunfacturResource;
use App\Http\Resources\CategorysMaunfacturResource;
use App\Repository\CategoryRtepository\Category_Maunfactur_Repository\Category_Maunfactur_Repository_Interface;
use App\Repository\CategoryRtepository\CategoryRtepositoryInterface;
use App\Repository\ManufactureRtepository\ManufactureRtepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\manufactures;
use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\Types\Null_;


class manufacture extends Controller
{
    /**
     * @var manufactures
     */
    /**
     * @var ManufactureRtepositoryInterface
     */
    protected $Manufacture;
    /**
     * @var CategoryRtepositoryInterface
     */
    protected $Category;
    /**
     * @var Category_Maunfactur_Repository_Interface
     */
    protected $Category_Maunfactur;

    public function __construct(ManufactureRtepositoryInterface $Manufacture
        , CategoryRtepositoryInterface $Category
        , Category_Maunfactur_Repository_Interface $Category_Maunfactur
    )
    {
        $this->Manufacture = $Manufacture;
        $this->Category = $Category;
        $this->Category_Maunfactur = $Category_Maunfactur;
    }

    public function brand()
    {
        $all_categorys = $this->Category->show();
//        $all_categorys=categorys::select('category_id','category_name')->get();

        return view('admin.add-manufacture', [
            "categorys" => $all_categorys
        ]);
    }

    protected function validator($Request)
    {
        $messages = [
            'name.required' => trans('Validation.manufacture.name.required'),
            'name.max' => trans('Validation.manufacture.name.max'),
            'name.min' => trans('Validation.manufacture.name.min'),
            'name.string' => trans('Validation.manufacture.name.string'),
            'description.string' => trans('Validation.manufacture.description.string'),
            'description.max' => trans('Validation.manufacture.description.max'),
            'category_id.max' => trans('Validation.manufacture.category_id.max'),
            'category_id.required' => trans('Validation.manufacture.category_id.required'),
            'category_id.numeric' => trans('Validation.manufacture.category_id.numeric'),

        ];

        return Validator::make($Request, [
            'name' => 'required|string|max:90|min:3',
            'description' => 'string|nullable|max:65534',
            'category_id' => 'required|numeric',
        ], $messages);
    }

    public function savemanuadd(Request $Request)
    {
        $validation = $this->validator($Request->all());
        if ($validation->fails())
            response()->json(['error' => $validation->errors()]);
        $output = $this->Manufacture->store($Request);
        return Helper::Result($output);
    }

    public function show_all()
    {
        $show_data_table = $this->Manufacture->all();
        return view('admin.allmanufacture', compact($show_data_table));
    }

    public function Act_manufacture(IdRequest $Request)
    {
        if ($Request->id) {
            $updated = $this->Manufacture->update_bottom($Request->id);
            return Helper::Result($updated);
        } else {
            return response()->json(['error' => trans('Validation.error')]);
        }
    }

    public function edit($id)
    {
        $db_info = $this->Manufacture->find_Manufacture($id);
        $categorys = $this->Category->show();
        $return = $this->Category_Maunfactur->category_id($id);
        $exp = Arr::flatten($return);
        $brand = $this->Category->category_brand($exp);
        return view('admin.EDIT_manufacture', compact('categorys', 'db_info', 'brand'));
    }

    public function SAVECAT(ManufactureRequest $request, $manufacture_id)
    {
        $this->Manufacture->updates($request, $manufacture_id);
        return redirect::to('/admin/admin_manufacture/allmanufacture');
    }

    public function del_category(Request $Request)
    {
        $val = $this->Manufacture->delete($Request->id);
        return Helper::Result($val);
    }

    public function Fetch_manufacture()
    {
        return brandServisResource::collection($this->Manufacture->all());
    }

    public function fetch_category(IdRequest $request)
    {
        return CategoryMaunfacturResource::collection($this->Category_Maunfactur->all($request->id));
    }

    public function fetch_categorys(IdRequest $request)
    {
        $return = $this->Category_Maunfactur->category_id($request->id);
        $exp = Arr::flatten($return);
        return CategorysMaunfacturResource::collection($this->Category->category_brand($exp));
    }

    public function chenge_category_manufacture(Request $request)
    {
        $this->Category_Maunfactur->store($request);
        $userData['data'] = true;
        echo json_encode($userData);
        exit;
    }

    function delete_category_manufacture(Request $request)
    {
        $userData['data'] = $this->Category_Maunfactur->destroy($request);
        return json_encode($userData);
        exit;
    }

}

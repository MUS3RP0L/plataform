<?php

namespace Muserpol\Http\Controllers\Affiliate;

use Illuminate\Http\Request;
use Muserpol\Http\Requests;
use Muserpol\Http\Controllers\Controller;

use DB;
use Auth;
use Validator;
use Session;
use Datatables;
use Carbon\Carbon;
use Muserpol\Helper\Util;

use Muserpol\Affiliate;
use Muserpol\Contribution;
use Muserpol\City;
use Muserpol\Spouse;
use Muserpol\EconomicComplement;

class AffiliateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return view('affiliates.index');
    }

    public function Data(Request $request)
    {
        $affiliates = Affiliate::select(['id', 'identity_card','city_identity_card_id', 'registration', 'last_name',
        'mothers_last_name', 'first_name', 'second_name',  'affiliate_state_id', 'degree_id',
        'eco_com_modality_id', 'b_identity_card', 'b_city_identity_card_id', 'b_name','b_last_name']);

        if ($request->has('last_name'))
        {
            $affiliates->where(function($affiliates) use ($request)
            {
                $last_name = trim($request->get('last_name'));
                $affiliates->where('last_name', 'like', "%{$last_name}%")->orwhere('b_last_name', 'like', "%{$last_name}%");;
            });
        }
        if ($request->has('mothers_last_name'))
        {
            $affiliates->where(function($affiliates) use ($request)
            {
                $mothers_last_name = trim($request->get('mothers_last_name'));
                $affiliates->where('mothers_last_name', 'like', "%{$mothers_last_name}%")->orwhere('b_mothers_last_name', 'like', "%{$mothers_last_name}%");;
            });
        }
        if ($request->has('first_name'))
        {
            $affiliates->where(function($affiliates) use ($request)
            {
                $first_name = trim($request->get('first_name'));
                $affiliates->where('first_name', 'like', "%{$first_name}%")->orwhere('b_first_name', 'like', "%{$first_name}%");;
            });
        }
        if ($request->has('second_name'))
        {
            $affiliates->where(function($affiliates) use ($request)
            {
                $second_name = trim($request->get('second_name'));
                $affiliates->where('second_name', 'like', "%{$second_name}%")->orwhere('b_second_name', 'like', "%{$second_name}%");
            });
        }
        if ($request->has('identity_card'))
        {
            $affiliates->where(function($affiliates) use ($request)
            {
                $identity_card = trim($request->get('identity_card'));
                $affiliates->where('identity_card', 'like', "%{$identity_card}%")->orwhere('b_identity_card', 'like', "%{$identity_card}%");
            });
        }



        return Datatables::of($affiliates)
                ->addColumn('degree', function ($affiliate) { return $affiliate->degree_id ? $affiliate->degree->shortened : ''; })
                ->editColumn('identity_card', function ($affiliate) { return $affiliate->city_identity_card_id ? $affiliate->identity_card .' '. City::idIs($affiliate->city_identity_card_id)->first()->shortened : $affiliate->identity_card; })
                ->editColumn('last_name', function ($affiliate) { return Util::ucw($affiliate->last_name); })
                ->editColumn('mothers_last_name', function ($affiliate) { return Util::ucw($affiliate->mothers_last_name); })
                ->addColumn('names', function ($affiliate) { return Util::ucw($affiliate->first_name) .' '. Util::ucw($affiliate->second_name); })

                ->editColumn('b_identity_card', function ($affiliate) { return $affiliate->b_city_identity_card_id ? $affiliate->b_identity_card .' '. City::idIs($affiliate->b_city_identity_card_id)->first()->shortened : $affiliate->b_identity_card; })

                ->editColumn('b_name', function ($affiliate) { return Util::ucw($affiliate->b_name); })

                ->addColumn('modality', function ($affiliate) { return $affiliate->eco_com_modality->name; })
                ->addColumn('action', function ($affiliate) { return  '
                        <div class="btn-group" style="margin:-3px 0;">
                            <a href="affiliate/'.$affiliate->id.'" class="btn btn-success btn-raised btn-sm"><i class="glyphicon glyphicon-eye-open"></i></a>
                        </div>';})
                ->make(true);
    }

    public static function getViewModel()
    {
        $cities = City::all();
        $cities_list = ['' => ''];
        foreach ($cities as $item) {
            $cities_list[$item->id]=$item->name;
        }

        $cities_list_short = ['' => ''];
        foreach ($cities as $item) {
            $cities_list_short[$item->id]=$item->shortened;
        }

        return [

            'cities_list' => $cities_list,
            'cities_list_short' => $cities_list_short

        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getData($affiliate)
    {
        $affiliate = Affiliate::idIs($affiliate)->first();
        $spouse = Spouse::affiliateidIs($affiliate->id)->first();
        if (!$spouse) { $spouse = new Spouse; }

        if ($affiliate->gender == 'M') {
            $gender_list = ['' => '', 'C' => 'CASADO', 'S' => 'SOLTERO', 'V' => 'VIUDO', 'D' => 'DIVORCIADO'];
        }elseif ($affiliate->gender == 'F') {
            $gender_list = ['' => '', 'C' => 'CASADA', 'S' => 'SOLTERA', 'V' => 'VIUDA', 'D' => 'DIVORCIADA'];
        }
        if ($affiliate->city_identity_card_id) {
            $affiliate->city_identity_card = City::idIs($affiliate->city_identity_card_id)->first()->shortened;
        }else {
            $affiliate->city_identity_card = '';
        }
        if ($affiliate->b_city_identity_card_id) {
            $affiliate->b_city_identity_card = City::idIs($affiliate->b_city_identity_card_id)->first()->shortened;
        }else {
            $affiliate->b_city_identity_card = '';
        }
        if ($affiliate->city_birth_id) {
            $affiliate->city_birth = City::idIs($affiliate->city_birth_id)->first()->name;
        }else {
            $affiliate->city_birth = '';
        }
        if ($affiliate->b_city_birth_id) {
            $affiliate->b_city_birth = City::idIs($affiliate->b_city_birth_id)->first()->name;
        }else {
            $affiliate->b_city_birth = '';
        }
        if ($affiliate->city_address_id) {
            $affiliate->city_address = City::idIs($affiliate->city_address_id)->first()->name;
        }else {
            $affiliate->city_address = '';
        }
        if ($affiliate->city_address_id || $affiliate->zone || $affiliate->Street || $affiliate->number_address || $affiliate->phone || $affiliate->cell_phone) {
            $info_address = TRUE;
        }else{
            $info_address = FALSE;
        }
        if ($spouse->identity_card) {
            $info_spouse = TRUE;
        }else{
            $info_spouse = FALSE;
        }

        $last_contribution = Contribution::affiliateidIs($affiliate->id)->orderBy('month_year', 'desc')->first();

        $consulta = DB::table('affiliates')
                        ->select(DB::raw('SUM(contributions.gain) as gain, SUM(contributions.public_security_bonus) as public_security_bonus,
                                        SUM(contributions.quotable) as quotable, SUM(contributions.total) as total,
                                        SUM(contributions.retirement_fund) as retirement_fund, SUM(contributions.mortuary_quota) as mortuary_quota'))
                        ->leftJoin('contributions', 'affiliates.id', '=', 'contributions.affiliate_id')
                        ->where('affiliates.id', '=', $affiliate->id)
                        ->get();

        foreach ($consulta as $item) {
            $total_gain = Util::formatMoney($item->gain);
            $total_public_security_bonus = Util::formatMoney($item->public_security_bonus);
            $total_quotable = Util::formatMoney($item->quotable);
            $total_retirement_fund = Util::formatMoney($item->retirement_fund);
            $total_mortuary_quota = Util::formatMoney($item->mortuary_quota);
            $total = Util::formatMoney($item->total);
        }

        $data = [

            'affiliate' => $affiliate,
            'spouse' => $spouse,
            'gender_list' => $gender_list,
            'info_address' => $info_address,
            'info_spouse' => $info_spouse,
            'last_contribution' => $last_contribution ? $last_contribution : 0,
            'total_gain' => $total_gain ? $total_gain : 0,
            'total_public_security_bonus' => $total_public_security_bonus ? $total_public_security_bonus : 0,
            'total_quotable' => $total_quotable ? $total_quotable : 0,
            'total_retirement_fund' => $total_retirement_fund ? $total_retirement_fund : 0,
            'total_mortuary_quota' => $total_mortuary_quota ? $total_mortuary_quota : 0,
            'total' => $total ? $total : 0

        ];

        $data = array_merge($data, self::getViewModel());
        return $data;
    }
    public function show($affiliate)
    {
        return view('affiliates.view', self::getData($affiliate->id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $affiliate)
    {
        return $this->save($request, $affiliate);
    }

    public function save($request, $affiliate = false)
    {
        $rules = [

            'last_name' => 'min:3',

        ];

        $messages = [

            'last_name.min' => 'El mínimo de caracteres permitidos para apellido paterno es 3',

        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect('affiliate/'.$affiliate->id)
            ->withErrors($validator)
            ->withInput();
        }
        else {

            $affiliate->user_id = Auth::user()->id;

            switch ($request->type) {

                case 'personal':

                    $affiliate->identity_card = trim($request->identity_card);
                    if ($request->city_identity_card_id) { $affiliate->city_identity_card_id = $request->city_identity_card_id; } else { $affiliate->city_identity_card_id = null; }
                    $affiliate->name = trim($request->name);
                    $affiliate->last_name = trim($request->last_name);
                    $affiliate->mothers_last_name = trim($request->mothers_last_name);
                    $affiliate->first_name = trim($request->first_name);
                    $affiliate->second_name = trim($request->second_name);
                    $affiliate->surname_husband = trim($request->surname_husband);

                    $affiliate->nua = trim($request->nua);

                    $affiliate->phone = trim($request->phone);
                    $affiliate->birth_date = Util::datePick($request->birth_date);
                    $affiliate->civil_status = trim($request->civil_status);
                    if ($request->city_birth_id) { $affiliate->city_birth_id = $request->city_birth_id; } else { $affiliate->city_birth_id = null; }
                    if ($request->DateDeathAffiliateCheck == "on") {
                        $affiliate->date_death = Util::datePick($request->date_death);
                        $affiliate->reason_death = trim($request->reason_death);
                    }else {
                        $affiliate->date_death = null;
                        $affiliate->reason_death = null;
                    }
                    $affiliate->save();

                    $message = "Información personal de Afiliado actualizado con éxito";

                break;

                case 'beneficiario':

                $affiliate->b_identity_card = trim($request->b_identity_card);
                if ($request->b_city_identity_card_id) { $affiliate->b_city_identity_card_id = $request->b_city_identity_card_id; } else { $affiliate->b_city_identity_card_id = null; }
                if ($request->b_city_birth_id) { $affiliate->b_city_birth_id = $request->b_city_birth_id; } else { $affiliate->b_city_birth_id = null; }

                $affiliate->b_name = trim($request->b_name);
                $affiliate->b_last_name = trim($request->b_last_name);
                $affiliate->b_mothers_last_name = trim($request->b_mothers_last_name);
                $affiliate->b_first_name = trim($request->b_first_name);
                $affiliate->b_second_name = trim($request->b_second_name);
                $affiliate->b_surname_husband = trim($request->b_surname_husband);
                $affiliate->nua = trim($request->nua);
                if ($request->phone) {$affiliate->phone = $request->phone;}

                $affiliate->b_birth_date = Util::datePick($request->b_birth_date);
                $affiliate->b_civil_status = trim($request->b_civil_status);

                $affiliate->save();

                    $message = "Información de beneficiario actualizado con éxito";

                break;

                case 'confirm':
                $economic_complement = new EconomicComplement;
                $economic_complement->affiliate_id = $affiliate->id;
                $economic_complement->user_id = Auth::user()->id;
                $economic_complement->save();

                $affiliate->registration = $economic_complement->id;

                $affiliate->save();

                    $message = "Listo Para Imprimir";

                break;

                Session::flash('message', $message);
            }


        }

        return redirect('affiliate/'.$affiliate->id);
    }

    public function SearchAffiliate(Request $request)
    {
        $rules = [
            'identity_card' => 'required',
        ];

        $messages = [
            'identity_card.required' => 'El campo es requerido para realizar la búsqueda del Afiliado.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect("/")
            ->withErrors($validator)
            ->withInput();
        }
        else{

        $affiliate = Affiliate::identitycardIs($request->identity_card)->first();

            if($affiliate) {
                return redirect("affiliate/{$affiliate->id}");
            }
            else {
                $message = "No logramos encontrar al Afiliado con Carnet: ".$request->identity_card;
                Session::flash('message', $message);
                return redirect("affiliate");
            }

        }
    }

    public function print_affiliate($affiliate)
    {
        $header1 = "DIRECCIÓN DE BENEFICIOS ECONÓMICOS";
        $header2 = "UNIDAD DE FONDO DE RETIRO POLICIAL INDIVIDUAL";
        $title = "REPORTE DE AFILIADO";
        $date = Util::getDateEdit(date('Y-m-d'));
        $current_date = Carbon::now();
        $hour = Carbon::parse($current_date)->toTimeString();
        $data = $this->getData($affiliate);
        $affiliate = $data['affiliate'];
        $spouse = $data['spouse'];
        $total_gain = $data['total_gain'];
        $total_public_security_bonus = $data['total_public_security_bonus'];
        $total_quotable = $data['total_quotable'];
        $total_retirement_fund = $data['total_retirement_fund'];
        $total_mortuary_quota = $data['total_mortuary_quota'];
        $total = $data['total'];
        $contributions = Contribution::select(['id', 'month_year', 'degree_id', 'unit_id', 'item', 'base_wage','seniority_bonus', 'study_bonus', 'position_bonus', 'border_bonus', 'east_bonus', 'public_security_bonus', 'gain', 'quotable', 'retirement_fund', 'mortuary_quota', 'total'])->where('affiliate_id', $affiliate->id)->get();
        $date = Util::getfulldate(date('Y-m-d'));
        $view = \View::make('affiliates.print.show', compact('header1','header2','title','date','hour','affiliate', 'spouse','total_gain','total_public_security_bonus','total_quotable','total_retirement_fund','total_mortuary_quota','total','contributions'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view)->setPaper('legal','landscape');
        return $pdf->stream();
    }

    public function print_declaracion1($affiliate)
    {
      $header1 = "DIRECCIÓN DE BENEFICIOS ECONÓMICOS";
      $header2 = "UNIDAD DE OTORGACIÓN DEL COMPLEMENTO ECONÓMICO";
      $title = "FORMULARIO DE DECLARACIÓN JURADA VOLUNTARIA";
      $date = Util::getDateEdit(date('Y-m-d'));
      $current_date = Carbon::now();
      $hour = Carbon::parse($current_date)->toTimeString();
      $data = $this->getData($affiliate);
      $affiliate = $data['affiliate'];
      $view = \View::make('affiliates.print.declaracion1', compact('header1','header2','title','date','hour','affiliate'))->render();
      $pdf = \App::make('dompdf.wrapper');
      $pdf->loadHTML($view)->setPaper('legal');
      return $pdf->stream();

    }
    public function print_declaracion2($affiliate)
    {
      $header1 = "DIRECCIÓN DE BENEFICIOS ECONÓMICOS";
      $header2 = "UNIDAD DE OTORGACIÓN DEL COMPLEMENTO ECONÓMICO";
      $title = "FORMULARIO DE DECLARACIÓN JURADA VOLUNTARIA";
      $date = Util::getDateEdit(date('Y-m-d'));
      $current_date = Carbon::now();
      $hour = Carbon::parse($current_date)->toTimeString();
      $data = $this->getData($affiliate);
      $affiliate = $data['affiliate'];
      $spouse = $data['spouse'];
      $view = \View::make('affiliates.print.declaracion2', compact('header1','header2','title','date','hour','affiliate','spouse'))->render();
      $pdf = \App::make('dompdf.wrapper');
      $pdf->loadHTML($view)->setPaper('legal');
      return $pdf->stream();

    }




}

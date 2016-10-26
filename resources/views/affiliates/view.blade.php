@extends('app')

@section('contentheader_title')
  <div class="row">
    <div class="col-md-6">
      {!! Breadcrumbs::render('show_affiliate', $affiliate) !!}
</div>
<div class="col-md-2 col-md-offset-2 text-right">
  {!! Form::model($affiliate, ['method' => 'PATCH', 'route' => ['affiliate.update', $affiliate], 'class' => 'form-horizontal']) !!}
  <input type="hidden" name="type" value="confirm"/>
  @if($affiliate->registration)
    <div class="btn-group" style="margin:0px 1px 12px;" data-toggle="tooltip" data-placement="bottom" data-original-title="Imprimir">
        <a href="" data-target="#myModal-print-affiliate" class="btn btn-raised btn-success dropdown-toggle enabled" data-toggle="modal">
            &nbsp;<span class="glyphicon glyphicon-print"></span>&nbsp;
        </a>
    </div>
  @else
  <div class="btn-group" style="margin:0px 1px 12px;" data-toggle="tooltip" data-placement="bottom" data-original-title="Confirmar">
      <button type="submit" class="btn btn-raised btn-success dropdown-toggle enabled" data-toggle="modal">
          &nbsp;<span class="glyphicon glyphicon-ok"></span>&nbsp;
      </a>
  </div>
@endif


{!! Form::close() !!}


</div>
<div class="col-md-2 text-right">
    <a href="{!! url('affiliate') !!}" style="margin:0px 1px 12px;" class="btn btn-raised btn-warning" data-toggle="tooltip" data-placement="bottom" data-original-title="Atrás">
        &nbsp;<span class="glyphicon glyphicon-share-alt"></span>&nbsp;
    </a>
</div>
</div>
@endsection

@section('main-content')
    <div class="row">
        <div class="col-md-12">
            <div class="row">


            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-md-11">
                                    <h3 class="panel-title"><span class="glyphicon glyphicon-user"></span> Información de Afiliado</h3>
                                </div>
                                @if($affiliate->identity_card)
                                <div class="col-md-1 text-right" data-toggle="tooltip" data-placement="top" data-original-title="Editar">
                                    <div data-toggle="modal" data-target="#myModal-personal">
                                        <span class="glyphicon glyphicon-pencil"  aria-hidden="true"></span>
                                    </div>
                                </div>
                              @endif
                            </div>
                        </div>
                        <div class="panel-body" style="font-size: 14px">
                            <div class="row">
                              @if($affiliate->identity_card)
                                <div class="col-md-6">

                                    <table class="table table-responsive" style="width:100%;">
                                        <tr>
                                            <td style="border-top:1px solid #d4e4cd;">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        Carnet de Identidad
                                                    </div>
                                                    <div class="col-md-6">
                                                        {!! $affiliate->identity_card !!} {!! $affiliate->city_identity_card !!}
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="border-top:1px solid #d4e4cd;">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        Grado
                                                    </div>
                                                    <div class="col-md-6" data-toggle="tooltip" data-placement="bottom" data-original-title="{!! $affiliate->degree->name !!}">
                                                      {!! $affiliate->degree->shortened !!}
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="border-top:1px solid #d4e4cd;">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        Apellido Paterno
                                                    </div>
                                                    <div class="col-md-6">
                                                        {!! $affiliate->last_name !!}
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="border-top:1px solid #d4e4cd;">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        Apellido Materno
                                                    </div>
                                                    <div class="col-md-6">
                                                        {!! $affiliate->mothers_last_name !!}
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="border-top:1px solid #d4e4cd;">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        Primer Nombre
                                                    </div>
                                                    <div class="col-md-6">
                                                        {!! $affiliate->first_name !!}
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="border-top:1px solid #d4e4cd;border-bottom:1px solid #d4e4cd;">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        Segundo Nombre
                                                    </div>
                                                    <div class="col-md-6">
                                                        {!! $affiliate->second_name !!}
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @if ($affiliate->surname_husband)
                                        <tr>
                                            <td style="border-top:1px solid #d4e4cd;border-bottom:1px solid #d4e4cd;">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        Apellido de Esposo
                                                    </div>
                                                    <div class="col-md-6">
                                                        {!! $affiliate->surname_husband !!}
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endif
                                        @if($affiliate->date_death)
                                            <tr>
                                                <td style="border-top:1px solid #d4e4cd;border-bottom:1px solid #d4e4cd;">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            Fecha de Deceso
                                                        </div>
                                                        <div class="col-md-6">
                                                            {!! $affiliate->getShortDateDeath() !!}
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endif
                                    </table>

                                </div>

                                <div class="col-md-6">

                                    <table class="table" style="width:100%;">

                                        <tr>
                                            <td style="border-top:1px solid #d4e4cd;">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        Fecha Nacimiento
                                                    </div>
                                                    <div class="col-md-6">
                                                         {!! $affiliate->getShortBirthDate() !!}
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @if($affiliate->getShortBirthDate())
                                        <tr>
                                            <td style="border-top:1px solid #d4e4cd;">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        Edad
                                                    </div>
                                                    <div class="col-md-6">
                                                        {!! $affiliate->getHowOld() !!}
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endif
                                        <tr>
                                            <td style="border-top:1px solid #d4e4cd;border-bottom:1px solid #d4e4cd;">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        CUA/NUA
                                                    </div>
                                                    <div class="col-md-6">
                                                        {!! $affiliate->nua !!}
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @if($affiliate->affiliate_state_id == 5)
                                        <tr>
                                            <td style="border-top:1px solid #d4e4cd;">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        Estado Civil
                                                    </div>
                                                    <div class="col-md-6">
                                                        {!! $affiliate->civil_status !!}
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="border-top:1px solid #d4e4cd;border-bottom:1px solid #d4e4cd;">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        Residencia
                                                    </div>
                                                    <div class="col-md-6">
                                                         {!! $affiliate->city_birth !!}
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td style="border-top:1px solid #d4e4cd;">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        Teléfono
                                                    </div>
                                                    <div class="col-md-6">
                                                        {!! $affiliate->phone !!}
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endif

                                        {{--
                                        @if($affiliate->reason_death)
                                            <tr>
                                                <td style="border-top:1px solid #d4e4cd;border-bottom:1px solid #d4e4cd;">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            Motivo de Deceso
                                                        </div>
                                                        <div class="col-md-6">
                                                            {!! $affiliate->reason_death !!}
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endif --}}

                                    </table>

                                </div>
                              @else
                                  <div class="row text-center">
                                      <div data-toggle="modal" data-target="#myModal-personal">
                                          <button type="button" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Adicionar Datos">
                                              <img class="circle" src="{!! asset('img/people.png') !!}" width="45px" alt="icon">
                                          </button>
                                      </div>
                                  </div>
                              @endif
                            </div>
                        </div>
                    </div>
                    @if($affiliate->affiliate_state_id <> 5)
                      <div class="panel panel-primary">
                          <div class="panel-heading">
                              <div class="row">
                                  <div class="col-md-11">
                                      <h3 class="panel-title"><span class="glyphicon glyphicon-user"></span> Información de Beneficiario</h3>
                                  </div>
                                      <div class="col-md-1 text-right" data-toggle="tooltip" data-placement="top" data-original-title="Editar">
                                          <div data-toggle="modal" data-target="#myModal-spouse">
                                              <span class="glyphicon glyphicon-pencil"  aria-hidden="true"></span>
                                          </div>
                                      </div>
                              </div>
                          </div>
                          <div class="panel-body" style="font-size: 14px">
                              <div class="row" style="margin-bottom:0px;">

                                      <div class="col-md-6">

                                          <table class="table" style="width:100%;">
                                              <tr>
                                                  <td style="border-top:1px solid #d4e4cd;">
                                                      <div class="row">
                                                          <div class="col-md-6">
                                                              Carnet Identidad
                                                          </div>
                                                          <div class="col-md-6">
                                                               {!! $affiliate->b_identity_card !!} {!! $affiliate->b_city_identity_card !!}
                                                          </div>
                                                      </div>
                                                  </td>
                                              </tr>
                                              <tr>
                                                  <td style="border-top:1px solid #d4e4cd;">
                                                      <div class="row">
                                                          <div class="col-md-6">
                                                              Apellido Paterno
                                                          </div>
                                                          <div class="col-md-6">
                                                               {!! $affiliate->b_last_name !!}
                                                          </div>
                                                      </div>
                                                  </td>
                                              </tr>
                                              <tr>
                                                  <td style="border-top:1px solid #d4e4cd;border-bottom:1px solid #d4e4cd;">
                                                      <div class="row">
                                                          <div class="col-md-6">
                                                              Apellido Materno
                                                          </div>
                                                          <div class="col-md-6">
                                                               {!! $affiliate->b_mothers_last_name !!}
                                                          </div>
                                                      </div>
                                                  </td>
                                              </tr>
                                              <tr>
                                                  <td style="border-top:1px solid #d4e4cd;">
                                                      <div class="row">
                                                          <div class="col-md-6">
                                                              Primer Nombre
                                                          </div>
                                                          <div class="col-md-6">
                                                              {!! $affiliate->b_first_name !!}
                                                          </div>
                                                      </div>
                                                  </td>
                                              <tr>
                                              </tr>
                                                  <td style="border-top:1px solid #d4e4cd;border-bottom:1px solid #d4e4cd;">
                                                      <div class="row">
                                                          <div class="col-md-6">
                                                              Segundo Nombre
                                                          </div>
                                                          <div class="col-md-6">
                                                              {!! $affiliate->b_second_name !!}
                                                          </div>
                                                      </div>
                                                  </td>
                                              </tr>
                                          </table>


                                      </div>

                                      <div class="col-md-6">

                                          <table class="table" style="width:100%;">
                                            @if ($affiliate->b_surname_husband)
                                            <tr>
                                                <td style="border-top:1px solid #d4e4cd;border-bottom:1px solid #d4e4cd;">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            Apellido de Esposo
                                                        </div>
                                                        <div class="col-md-6">
                                                            {!! $affiliate->b_surname_husband !!}
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endif
                                              <tr>
                                                  <td style="border-top:1px solid #d4e4cd;">
                                                      <div class="row">
                                                          <div class="col-md-6">
                                                              Fecha Nacimiento
                                                          </div>
                                                          <div class="col-md-6">
                                                               {!! $affiliate->b_getShortBirthDate() !!}
                                                          </div>
                                                      </div>
                                                  </td>
                                              </tr>
                                              <tr>
                                                  <td style="border-top:1px solid #d4e4cd;border-bottom:1px solid #d4e4cd;">
                                                      <div class="row">
                                                          <div class="col-md-6">
                                                              CUA/NUA
                                                          </div>
                                                          <div class="col-md-6">
                                                              {!! $affiliate->b_nua !!}
                                                          </div>
                                                      </div>
                                                  </td>
                                              </tr>
                                              <tr>
                                                  <td style="border-top:1px solid #d4e4cd;">
                                                      <div class="row">
                                                          <div class="col-md-6">
                                                              Estado Civil
                                                          </div>
                                                          <div class="col-md-6">
                                                              {!! $affiliate->b_civil_status !!}
                                                          </div>
                                                      </div>
                                                  </td>
                                              </tr>
                                              <tr>
                                                  <td style="border-top:1px solid #d4e4cd;border-bottom:1px solid #d4e4cd;">
                                                      <div class="row">
                                                          <div class="col-md-6">
                                                              Residencia
                                                          </div>
                                                          <div class="col-md-6">
                                                               {!! $affiliate->b_city_birth !!}
                                                          </div>
                                                      </div>
                                                  </td>
                                              </tr>
                                              @if($affiliate->affiliate_state_id <> 5)
                                              <tr>
                                                  <td style="border-top:1px solid #d4e4cd;">
                                                      <div class="row">
                                                          <div class="col-md-6">
                                                              Teléfono
                                                          </div>
                                                          <div class="col-md-6">
                                                              {!! $affiliate->phone !!}
                                                          </div>
                                                      </div>
                                                  </td>
                                              </tr>
                                              @endif

                                          </table>

                                      </div>

                              </div>
                          </div>
                      </div>

                    @endif
                </div>

            </div>

        </div>
    </div>

<div id="myModal-personal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Editar Información Personal</h4>
            </div>
            <div class="modal-body">

                {!! Form::model($affiliate, ['method' => 'PATCH', 'route' => ['affiliate.update', $affiliate], 'class' => 'form-horizontal']) !!}
                    <input type="hidden" name="type" value="personal"/>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                    {!! Form::label('identity_card', 'Carnet de Identidad', ['class' => 'col-md-5 control-label']) !!}
                                <div class="col-md-5">
                                    {!! Form::text('identity_card', $affiliate->identity_card, ['class'=> 'form-control']) !!}
                                    <span class="help-block">Número de CI</span>
                                </div>
                                    {!! Form::select('city_identity_card_id', $cities_list_short, $affiliate->city_identity_card_id, ['class' => 'col-md-2 combobox form-control']) !!}
                            </div>
                            <div class="form-group">
                                    {!! Form::label('last_name', 'Apellido Paterno', ['class' => 'col-md-5 control-label']) !!}
                                <div class="col-md-7">
                                    {!! Form::text('last_name', $affiliate->last_name, ['class'=> 'form-control', 'onkeyup' => 'this.value=this.value.toUpperCase()']) !!}
                                    <span class="help-block">Escriba el Apellido Paterno</span>
                                </div>
                            </div>
                            <div class="form-group">
                                    {!! Form::label('mothers_last_name', 'Apellido Materno', ['class' => 'col-md-5 control-label']) !!}
                                <div class="col-md-7">
                                    {!! Form::text('mothers_last_name', $affiliate->mothers_last_name, ['class'=> 'form-control', 'onkeyup' => 'this.value=this.value.toUpperCase()']) !!}
                                    <span class="help-block">Escriba el Apellido Materno</span>
                                </div>
                            </div>
                            <div class="form-group">
                                    {!! Form::label('first_name', 'Primer Nombre', ['class' => 'col-md-5 control-label']) !!}
                                <div class="col-md-7">
                                    {!! Form::text('first_name', $affiliate->first_name, ['class'=> 'form-control','required', 'onkeyup' => 'this.value=this.value.toUpperCase()']) !!}
                                    <span class="help-block">Escriba el  Primer Nombre</span>
                                </div>
                            </div>
                            <div class="form-group">
                                    {!! Form::label('second_name', 'Segundo Nombre', ['class' => 'col-md-5 control-label']) !!}
                                <div class="col-md-7">
                                    {!! Form::text('second_name', $affiliate->second_name, ['class'=> 'form-control', 'onkeyup' => 'this.value=this.value.toUpperCase()']) !!}
                                    <span class="help-block">Escriba el Segundo Nombre</span>
                                </div>
                            </div>
                            @if ($affiliate->sex == 'F')
                                <div class="form-group">
                                        {!! Form::label('surname_husband', 'Apellido de Esposo', ['class' => 'col-md-5 control-label']) !!}
                                    <div class="col-md-7">
                                        {!! Form::text('surname_husband', $affiliate->surname_husband, ['class'=> 'form-control', 'onkeyup' => 'this.value=this.value.toUpperCase()']) !!}
                                        <span class="help-block">Escriba el Apellido de Esposo (Opcional)</span>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                    {!! Form::label('birth_date', 'Fecha de Nacimiento', ['class' => 'col-md-5 control-label']) !!}
                                <div class="col-md-7">
                        			<div class="input-group">
                                        <input type="text" class="form-control datepicker" name="birth_date" value="{!! $affiliate->getEditBirthDate() !!}">
                                        <div class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                    {!! Form::label('nua', 'CUA/NUA', ['class' => 'col-md-5 control-label']) !!}
                                <div class="col-md-6">
                                    {!! Form::text('nua', $affiliate->nua, ['class'=> 'form-control', 'onkeyup' => 'this.value=this.value.toUpperCase()']) !!}
                                    <span class="help-block">Escriba el número de CUA/NUA</span>
                                </div>
                            </div>
                            @if($affiliate->affiliate_state_id == 5)
                            <div class="form-group">
                                        {!! Form::label('civil_status', 'Estado Civil', ['class' => 'col-md-5 control-label']) !!}
                                <div class="col-md-7">
                                    {!! Form::text('civil_status', $affiliate->civil_status, ['class'=> 'form-control', 'onkeyup' => 'this.value=this.value.toUpperCase()']) !!}
                                    <span class="help-block">Seleccione el Estado Civil</span>
                                </div>
                            </div>
                            <div class="form-group">
                                        {!! Form::label('city_birth_id', 'Lugar de Residencia', ['class' => 'col-md-5 control-label']) !!}
                                <div class="col-md-7">
                                    {!! Form::select('city_birth_id', $cities_list, $affiliate->city_birth_id, ['class' => 'combobox form-control']) !!}
                                    <span class="help-block">Seleccione Departamento</span>
                                </div>
                            </div>

                            <div class="form-group">
                                    {!! Form::label('phone', 'Teléfono fijo', ['class' => 'col-md-5 control-label']) !!}
                                <div class="col-md-6">
                                    {!! Form::text('phone', $affiliate->phone, ['class'=> 'form-control']) !!}
                                    <span class="help-block">Escriba el Teléfono</span>
                                </div>
                            </div>
                          @endif
                            {{-- <div class="form-group">
                                        {!! Form::label('civil_status', 'Estado Civil', ['class' => 'col-md-5 control-label']) !!}
                                <div class="col-md-7">
                                    {!! Form::select('civil_status', $gender_list, $affiliate->civil_status, ['class' => 'combobox form-control']) !!}
                                    <span class="help-block">Seleccione el Estado Civil</span>
                                </div>
                            </div>
                            <div class="form-group">
                                        {!! Form::label('city_birth_id', 'Lugar de Nacimiento', ['class' => 'col-md-5 control-label']) !!}
                                <div class="col-md-7">
                                    {!! Form::select('city_birth_id', $cities_list, $affiliate->city_birth_id, ['class' => 'combobox form-control']) !!}
                                    <span class="help-block">Seleccione Departamento</span>
                                </div>
                            </div> --}}

                            {{-- <div class="row">
                                <div class="col-md-offset-5 col-md-4">
                                    <div class="form-group">
                                        <div class="togglebutton">
                                          <label>
                                            <input type="checkbox" data-bind="checked: DateDeathAffiliateValue" name="DateDeathAffiliateCheck"> Fallecido
                                          </label>
                                      </div>
                                    </div>
                                </div>
                            </div> --}}

                            <div data-bind='fadeVisible: DateDeathAffiliateValue, valueUpdate: "afterkeydown"'>

                                <div class="form-group">
                                        {!! Form::label('date_death', 'Fecha Deceso', ['class' => 'col-md-5 control-label']) !!}
                                    <div class="col-md-7">
                                        <div class="input-group">
                                            <input type="text" class="form-control datepicker" name="date_death" value="{!! $affiliate->getEditDateDeath() !!}">
                                            <div class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                        {!! Form::label('reason_death', 'Causa Deceso', ['class' => 'col-md-5 control-label']) !!}
                                    <div class="col-md-6">
                                        {!! Form::textarea('reason_death', $affiliate->reason_death, ['class'=> 'form-control', 'rows' => '1']) !!}
                                        <span class="help-block">Escriba el Motivo de fallecimiento</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row text-center">
                        <div class="form-group">
                            <div class="col-md-12">
                                <a href="{!! url('affiliate/' . $affiliate->id) !!}" class="btn btn-raised btn-warning" data-toggle="tooltip" data-placement="bottom" data-original-title="Cancelar">&nbsp;<i class="glyphicon glyphicon-remove"></i>&nbsp;</a>
                                &nbsp;&nbsp;
                                <button type="submit" class="btn btn-raised btn-success" data-toggle="tooltip" data-placement="bottom" data-original-title="Guardar">&nbsp;<i class="glyphicon glyphicon-floppy-disk"></i>&nbsp;</button>
                            </div>
                        </div>
                    </div>

                {!! Form::close() !!}

            </div>
        </div>
    </div>
</div>

<div id="myModal-spouse" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content panel-warning">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Editar Información de Conyuge</h4>
            </div>
            <div class="modal-body">

              {!! Form::model($affiliate, ['method' => 'PATCH', 'route' => ['affiliate.update', $affiliate], 'class' => 'form-horizontal']) !!}
                  <input type="hidden" name="type" value="beneficiario"/>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                    {!! Form::label('b_identity_card', 'Carnet de Identidad', ['class' => 'col-md-5 control-label']) !!}
                                <div class="col-md-5">
                                    {!! Form::text('b_identity_card', $affiliate->b_identity_card, ['class'=> 'form-control']) !!}
                                    <span class="help-block">Número de CI</span>
                                </div>
                                    {!! Form::select('b_city_identity_card_id', $cities_list_short, $affiliate->b_city_identity_card_id, ['class' => 'col-md-2 combobox form-control']) !!}
                            </div>

                            <div class="form-group">
                                    {!! Form::label('b_last_name', 'Apellido Paterno', ['class' => 'col-md-5 control-label']) !!}
                                <div class="col-md-7">
                                    {!! Form::text('b_last_name', $affiliate->b_last_name, ['class'=> 'form-control','required', 'onkeyup' => 'this.value=this.value.toUpperCase()']) !!}
                                    <span class="help-block">Escriba el Apellido Paterno</span>
                                </div>
                            </div>
                            <div class="form-group">
                                    {!! Form::label('b_mothers_last_name', 'Apellido Materno', ['class' => 'col-md-5 control-label']) !!}
                                <div class="col-md-7">
                                    {!! Form::text('b_mothers_last_name', $affiliate->b_mothers_last_name, ['class'=> 'form-control', 'onkeyup' => 'this.value=this.value.toUpperCase()']) !!}
                                    <span class="help-block">Escriba el  Apellido Materno</span>
                                </div>
                            </div>
                            <div class="form-group">
                                    {!! Form::label('b_first_name', 'Primer Nombre', ['class' => 'col-md-5 control-label']) !!}
                                <div class="col-md-7">
                                    {!! Form::text('b_first_name', $affiliate->b_first_name, ['class'=> 'form-control','onkeyup' => 'this.value=this.value.toUpperCase()']) !!}
                                    <span class="help-block">Escriba el Primer Nombre</span>
                                </div>
                            </div>
                            <div class="form-group">
                                    {!! Form::label('b_second_name', 'Segundo Nombre', ['class' => 'col-md-5 control-label']) !!}
                                <div class="col-md-7">
                                    {!! Form::text('b_second_name', $affiliate->b_second_name, ['class'=> 'form-control', 'onkeyup' => 'this.value=this.value.toUpperCase()']) !!}
                                    <span class="help-block">Escriba el Segundo Nombre</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                                  {!! Form::label('b_surname_husband', 'Apellido de Esposo', ['class' => 'col-md-5 control-label']) !!}
                              <div class="col-md-7">
                                  {!! Form::text('b_surname_husband', $affiliate->b_surname_husband, ['class'=> 'form-control', 'onkeyup' => 'this.value=this.value.toUpperCase()']) !!}
                                  <span class="help-block">Escriba el Apellido de Esposo (Opcional)</span>
                              </div>
                          </div>
                            <div class="form-group">
                                    {!! Form::label('b_birth_date', 'Fecha Nacimiento', ['class' => 'col-md-5 control-label']) !!}
                                <div class="col-md-7">
                                    <div class="input-group">
                                        <input type="text" class="form-control datepicker" name="b_birth_date" value="{!! $affiliate->b_getEditBirthDate() !!}">
                                        <div class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                    {!! Form::label('b_nua', 'CUA/NUA', ['class' => 'col-md-5 control-label']) !!}
                                <div class="col-md-6">
                                    {!! Form::text('b_nua', $affiliate->b_nua, ['class'=> 'form-control', 'onkeyup' => 'this.value=this.value.toUpperCase()']) !!}
                                    <span class="help-block">Escriba el número de CUA/NUA</span>
                                </div>
                            </div>
                            <div class="form-group">
                                        {!! Form::label('b_civil_status', 'Estado Civil', ['class' => 'col-md-5 control-label']) !!}
                                <div class="col-md-7">
                                    {!! Form::text('b_civil_status', $affiliate->b_civil_status, ['class'=> 'form-control', 'onkeyup' => 'this.value=this.value.toUpperCase()']) !!}
                                    <span class="help-block">Seleccione el Estado Civil</span>
                                </div>
                            </div>
                            <div class="form-group">
                                        {!! Form::label('b_city_birth_id', 'Lugar de Residencia', ['class' => 'col-md-5 control-label']) !!}
                                <div class="col-md-7">
                                    {!! Form::select('b_city_birth_id', $cities_list, $affiliate->b_city_birth_id, ['class' => 'combobox form-control']) !!}
                                    <span class="help-block">Seleccione Departamento</span>
                                </div>
                            </div>
                            @if($affiliate->affiliate_state_id <> 5)
                              <div class="form-group">
                                    {!! Form::label('phone', 'Teléfono fijo', ['class' => 'col-md-5 control-label']) !!}
                                <div class="col-md-6">
                                    {!! Form::text('phone', $affiliate->phone, ['class'=> 'form-control']) !!}
                                    <span class="help-block">Escriba el Teléfono fijo</span>
                                </div>
                            </div>
                          @endif
                        </div>
                    </div>

                    <div class="row text-center">
                        <div class="form-group">
                            <div class="col-md-12">
                                <a href="{!! url('affiliate/' . $affiliate->id) !!}" data-target="#" class="btn btn-raised btn-warning">&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;&nbsp;</a>
                                &nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-raised btn-success">&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span>&nbsp;&nbsp;&nbsp;</button>
                            </div>
                        </div>
                    </div>

                {!! Form::close() !!}

            </div>
        </div>
    </div>
</div>

<div id="myModal-print-affiliate" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content panel-warning">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Reporte Afiliado</h4>
            </div>
            <div class="modal-body">
                @if($affiliate->affiliate_state_id == 5)
                  <iframe src="{!! url('print_declaracion1/' . $affiliate->id) !!}" width="99%" height="1200"></iframe>
                @else
                  <iframe src="{!! url('print_declaracion2/' . $affiliate->id) !!}" width="99%" height="1200"></iframe>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')

<script>

    $(document).ready(function(){
        $('.combobox').combobox();
        $('[data-toggle="tooltip"]').tooltip();
    });

    $('.datepicker').datepicker({
        format: "dd/mm/yyyy",
        language: "es",
        orientation: "bottom right",
        daysOfWeekDisabled: "0,6",
        autoclose: true
    });

    var affiliate = {!! $affiliate !!};

    var Model = function() {
        this.DateDeathAffiliateValue = ko.observable(affiliate.date_death ? true : false);
    };

    ko.bindingHandlers.fadeVisible = {
        init: function(element, valueAccessor) {
            var value = valueAccessor();
            $(element).toggle(ko.unwrap(value));
        },
        update: function(element, valueAccessor) {
            var value = valueAccessor();
            ko.unwrap(value) ? $(element).fadeIn() : $(element).fadeOut();
        }
    };

    ko.applyBindings(new Model());

    $(function() {
        $('#record-table').DataTable({
            "dom": '<"top">t<"bottom"p>',
            "order": [[ 0, "desc" ]],
            processing: true,
            serverSide: true,
            pageLength: 10,
            bFilter: false,
            ajax: {
                url: '{!! route('get_record') !!}',
                data: function (d) {
                    d.id = {{ $affiliate->id }};
                }
            },
            columns: [
                { data: 'date' },
                { data: 'message', bSortable: false }
            ]
        });
    });

</script>

@endpush

<?php

namespace Muserpol\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;

use Maatwebsite\Excel\Facades\Excel;
use Muserpol\Helper\Util;
use Carbon\Carbon;

use Muserpol\Affiliate;
use Muserpol\Breakdown;
use Muserpol\Degree;
use Muserpol\Category;
use Muserpol\Unit;
// use Muserpol\Contribution;

use Muserpol\City;
use Muserpol\EconomicComplementModality;
use Muserpol\PensionEntity;

class ImportAffiEcoCom extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */

    protected $signature = 'import:eco';

    /**
     * The console command description.
     *
     * @var string
     */

    protected $description = 'Import Payroll provided by General Command';

    /**
     * Execute the console command.
     *
     * @return mixed
     */

    public function handle()
    {
        global $NewAffi, $UpdateAffi, $NewContri, $Progress, $FolderName, $Date;

        $password = $this->ask('Enter the password');

        if ($password == ACCESS) {

            $FolderName = $this->ask('Enter the name of the folder you want to import');

            if ($this->confirm('Are you sure to import the folder "' . $FolderName . '" ? [y|N]') && $FolderName) {

                $time_start = microtime(true);
                $this->info("Working...\n");
                $Progress = $this->output->createProgressBar();
                $Progress->setFormat("%current%/%max% [%bar%] %percent:3s%%");

                Excel::batch('public/file_to_import/' . $FolderName . '/', function($rows, $file) {

                    $rows->each(function($result) {

                        global $NewAffi, $UpdateAffi, $NewContri, $Progress, $FolderName, $Date;
                        ini_set('memory_limit', '-1');
                        ini_set('max_execution_time', '-1');
                        ini_set('max_input_time', '-1');
                        set_time_limit('-1');

                        // if (!isset($result->car) or !isset($result->pat) or !isset($result->mat) or !isset($result->nom) or
                        //     !isset($result->nom2) or !isset($result->apes) or !isset($result->eciv) or !isset($result->sex) or
                        //     !isset($result->nac) or !isset($result->ing) or !isset($result->mes) or !isset($result->a_o) or
                        //     !isset($result->uni) or !isset($result->desg) or !isset($result->niv) or !isset($result->gra) or
                        //     !isset($result->item) or !isset($result->sue) or !isset($result->cat) or !isset($result->est) or
                        //     !isset($result->carg) or !isset($result->fro) or !isset($result->ori) or
                        //     //  !isset($result->bseg) or
                        //     !isset($result->dfu) or !isset($result->nat) or !isset($result->lac) or !isset($result->pre) or
                        //     !isset($result->sub) or !isset($result->gan) or !isset($result->afp) or !isset($result->pag) or
                        //     !isset($result->nua) or !isset($result->mus)) {
                        //     $this->error('Missing columns in the file!');
                        //     exit();
                        // }

                        // switch ($FolderName) {
                        //
                        //     case 'c1':
                        //         $first_name = Util::FirstName($result->nom);
                        //         $second_name = Util::SecondName($result->nom);
                        //         $birth_date = Util::dateDDMMAA($result->nac);
                        //         $date_entry = Util::dateDDMMAA($result->ing);
                        //     break;
                        //
                        //     case 'c2':
                        //         $first_name = Util::FirstName($result->nom);
                        //         $second_name = Util::SecondName($result->nom);
                        //         $birth_date = Util::dateAAMMDD($result->nac);
                        //         $date_entry = Util::dateAAMMDD($result->ing);
                        //     break;
                        //
                        //     case 'c3':
                        //         $first_name = Util::FirstName($result->nom);
                        //         $second_name = Util::SecondName($result->nom);
                        //         $birth_date = Util::dateAADDMM($result->nac);
                        //         $date_entry = Util::dateAADDMM($result->ing);
                        //     break;
                        //
                        //     case 'c4':
                        //         $first_name = $result->nom;
                        //         $second_name = $result->nom2;
                        //         $birth_date = Util::dateAAMMDD($result->nac);
                        //         $date_entry = Util::dateAAMMDD($result->ing);
                        //     break;
                        //
                        //     case 'c5':
                        //         $first_name = $result->nom;
                        //         $second_name = $result->nom2;
                        //         $birth_date = Util::dateDDMMAA($result->nac);
                        //         $date_entry = Util::dateDDMMAA($result->ing);
                        //     break;
                        //
                        //     default:
                                $first_name = $result->nom;
                                $second_name = $result->nom2;
                                // $birth_date = Util::date($result->nac);
                                // $date_entry = Util::date($result->ing);
                        // }
                        // $Date = Util::zero($result->mes) . "-" . Util::formatYear($result->a_o);

                        // $month_year = Carbon::createFromDate(Util::formatYear($result->a_o), Util::zero($result->mes), 1)->toDateString();

                        // if (is_null($result->desg)) {$result->desg = 0;}
                        // $breakdown_id = Breakdown::select('id')->where('code', $result->desg)->first()->id;

                        // if ($breakdown_id == 1) {
                        //     $unit_id = Unit::select('id')->where('breakdown_id', 1)->where('code', '20190')->first()->id;
                        // }
                        // elseif ($breakdown_id == 2) {
                        //     $unit_id = Unit::select('id')->where('breakdown_id', 2)->where('code', '20190')->first()->id;
                        // }
                        // elseif ($breakdown_id == 3) {
                        //     $unit_id = Unit::select('id')->where('breakdown_id', 3)->where('code', '20190')->first()->id;
                        // }
                        // else{
                        //     if (Unit::select('id')->where('breakdown_id', $breakdown_id)->where('code', $result->uni)->first()) {
                        //         $unit_id = Unit::select('id')->where('breakdown_id', $breakdown_id)->where('code', $result->uni)->first()->id;
                        //     }else {
                        //         $unit_id = Unit::select('id')->where('code', $result->uni)->first()->id;
                        //     }
                        // }

                        // if($result->niv && $result->gra) {
                        //     if ($result->niv == '04' && $result->gra == '15'){$result->niv = '03';}
                        //     $degree_id = Degree::select('id')->where('code_level', $result->niv)->where('code_degree', $result->gra)->first()->id;
                        // }

                        // $category_id = Category::select('id')->where('percentage', Util::CalcCategory(Util::decimal($result->cat),Util::decimal($result->sue)))->first()->id;

                        $affiliate = Affiliate::where('identity_card', '=', Util::zero($result->ci))->first();

                        if (!$affiliate) {
                            // $affiliate = Affiliate::where('last_name', '=', $result->pat)->where('mothers_last_name', '=', $result->mat)
                            //                     ->where('birth_date', '=', $birth_date)->where('date_entry', '=', $date_entry)
                            //                     ->where('identity_card', '=', Util::RepeatedIdentityCard($result->car))->first();

                            if (!$affiliate) {

                                $affiliate = new Affiliate;
                                $affiliate->identity_card = Util::zero($result->ci);
                                $affiliate->name = Util::zero($result->name);



                                $NewAffi ++;

                            }
                            else{$UpdateAffi ++;}
                        }
                        else{$UpdateAffi ++;}

                        $city_identity_card_id = City::select('id')->where('shortened', $result->city_identity_card)->first()->id;
                        $affiliate->city_identity_card_id = $city_identity_card_id;

                        $city_id = City::select('id')->where('name', $result->city)->first()->id;
                        $affiliate->city_id = $city_id;

                        $degree_id = Degree::select('id')->where('shortened', $result->degree)->first()->id;
                        $affiliate->degree_id = $degree_id;

                        $eco_com_modality_id = EconomicComplementModality::select('id')->where('name', $result->modality)->first()->id;
                        $affiliate->eco_com_modality_id = $eco_com_modality_id;
                        //
                        $pension_entity_id = PensionEntity::select('id')->where('name', $result->pension_entity)->first()->id;
                        $affiliate->pension_entity_id = $pension_entity_id;
                        //
                        $category_id = Category::select('id')->where('name', $result->category)->first()->id;
                        $affiliate->category_id = $category_id;

                        // $affiliate->change_date = $month_year;
                        //
                        $eco_com_type_id = EconomicComplementModality::select('eco_com_type_id')->where('name', $result->modality)->first()->eco_com_type_id;

                        switch ($eco_com_type_id) {

                            case '1'://Disponibilidad
                                $affiliate->affiliate_state_id = 5;
                            break;

                            case '2'://Comisión
                                $affiliate->affiliate_state_id = 4;
                            break;

                            default://Servicio
                                $affiliate->affiliate_state_id = 1;
                        }

                        // switch ($result->desg) {
                        //
                        //     case '5': //Batallón
                        //         $affiliate->affiliate_type_id = 2;
                        //     break;
                        //
                        //     default://Comando
                        //         $affiliate->affiliate_type_id = 1;
                        // }

                        // if ($result->uni) {
                        //     $affiliate->unit_id = $unit_id;
                        // }
                        // if ($result->gra) {
                        //     $affiliate->degree_id = $degree_id;
                        // }

                        // $affiliate->category_id = $category_id;
                        $affiliate->user_id = 1;
                        $affiliate->last_name = Util::replaceCharacter($result->pat);
                        $affiliate->mothers_last_name = Util::replaceCharacter($result->mat);
                        $affiliate->first_name = Util::replaceCharacter($first_name);
                        $affiliate->second_name = Util::replaceCharacter($second_name);
                        $affiliate->surname_husband = Util::replaceCharacter($result->apes);
                        // $affiliate->civil_status = $result->eciv;
                        // // $affiliate->nua = $result->nua;
                        // // $affiliate->afp = Util::getAfp($result->afp);
                        // $affiliate->item = $result->item;
                        // $affiliate->birth_date = $birth_date;
                        // $affiliate->date_entry = $date_entry;
                        // $affiliate->registration = Util::CalcRegistration($affiliate->birth_date, $affiliate->last_name, $affiliate->mothers_last_name, $affiliate->first_name, $affiliate->gender);
                        $affiliate->save();

                        $Progress->advance();

                    });

                });

                $time_end = microtime(true);

                $execution_time = ($time_end - $time_start)/60;

                $TotalAffi = $NewAffi + $UpdateAffi;
                $TotalNewAffi = $NewAffi ? $NewAffi : "0";
                $TotalUpdateAffi = $UpdateAffi ? $UpdateAffi : "0";
                $TotalAffi = $TotalAffi ? $TotalAffi : "0";

                $Progress->finish();

                $this->info("\n\nReport $Date:\n
                    $TotalNewAffi new affiliates.\n
                    $TotalUpdateAffi affiliates successfully updated.\n
                    Total $TotalAffi affiliates.\n

                    Execution time $execution_time [minutes].\n");

                // \Storage::disk('local')->put('ImportPayroll_'. $Date.'.txt', "\n\nReport:\n\n
                //     $TotalNewAffi new affiliates.\n
                //     $TotalUpdateAffi affiliates successfully updated.\n
                //     Total $TotalAffi affiliates.\n
                //     Execution time $execution_time [minutes].\n");
            }
        }
        else{
            $this->error('Incorrect password!');
            exit();
        }
    }
}

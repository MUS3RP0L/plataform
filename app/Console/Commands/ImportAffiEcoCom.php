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

                        $affiliate = Affiliate::where('identity_card', '=', Util::zero($result->ci))->first();

                        if (!$affiliate) {
                            // $affiliate = Affiliate::where('last_name', '=', $result->pat)->where('mothers_last_name', '=', $result->mat)
                            //                     ->where('birth_date', '=', $birth_date)->where('date_entry', '=', $date_entry)
                            //                     ->where('identity_card', '=', Util::RepeatedIdentityCard($result->car))->first();

                            if (!$affiliate) {

                                $affiliate = new Affiliate;
                                $affiliate->identity_card = Util::zero($result->ci);
                                $affiliate->name = Util::zero($result->name);
                                $first_name =
                                $second_name = ;


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

                        $affiliate->user_id = 1;
                        $affiliate->last_name = Util::replaceCharacter($result->pat);
                        $affiliate->mothers_last_name = Util::replaceCharacter($result->mat);
                        $affiliate->first_name = Util::replaceCharacter($result->nom);
                        $affiliate->second_name = Util::replaceCharacter($result->nom2);
                        $affiliate->surname_husband = Util::replaceCharacter($result->apes);
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

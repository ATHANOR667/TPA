<?php

namespace App\Http\Controllers;

use App\Http\Requests\Data\TPA_Mission_Request;
use App\Http\Requests\Experience_Request;
use App\Models\Experience;
use App\Models\Mission;
use App\Models\particulier;
use App\Models\professionnel;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;



class TPA_Controller extends TPA_Auth_Controller
{
    public function Acceuil()
    {
            return view('TPA.Pages.Acceuil.guest');
    }

    public function Acceuil_part(particulier $part)
    {
        $exps = \App\Models\Experience::select('fonction')->distinct()->get();
            return view('TPA.Pages.Acceuil.part')->with(['part'=>$part,'exps'=>$exps]);
    }

    public function Acceuil_pro(professionnel $pro , particulier $part)
    {
        $exps = $pro->Experience()->get();
            return view('TPA.Pages.Acceuil.pro')->with(['part'=>$part,'pro'=>$pro,'exps'=>$exps]);
    }


    /**
     * CONTROLLER DES EXPERIENCES
     *
     */




    public function experience(professionnel $pro )
    {
        $part = particulier::where('email','=',$pro->email)->get();
        return view('TPA.Data.exp')->with(['part'=>$part,'pro'=>$pro]);
    }

    public function exp_process(professionnel $pro, Experience_Request $request)//
    {
        $part = particulier::where('email','=',$pro->email)->get();
        $exp = $request->validated();
        Experience::create([
            'fonction'=>$exp['fonction'],
            'debut'=>$exp['debut'],
            'fin'=>$exp['fin'],
            'remuneration'=>$exp['remuneration'],
            'desc_rem'=>$exp['desc_rem'],
            'qualification'=>$exp['qualification'],
            'professionnel_id'=>$pro->id
        ]);
        return redirect(route('TPA.acceuil_pro')->with(['part'=>$part,'pro'=>$pro]));//->with('message','Operation reussie');

    }

    public function experience_edit(professionnel $pro,particulier $part,Experience $exp)
    {
        return view('TPA.Data.exp')->with(['part'=>$part,'pro'=>$pro,'exp'=>$exp]);
    }

    /**
     * CONTROLLER DES MISSIONS
     *
     */

    public function mission()
    {
        return view('TPA.Data.mission');
    }

    public function mission_process( professionnel $pro ,particulier $part, TPA_Mission_Request $request)
    {
        $mission = Mission::create([
            'intitule' =>$request->intitule,
            'description' => $request->description,
            'fonction' =>$request->fonction,
            'debut' => $request->debut,
            'fin' => $request->fin,
            'remuneration'=>$request->remuneration,
            'desc_rem'=>$request->desc_rem,
            'qualification'=>$request->qualification,
            'statut'=>'en attente'
        ]);
        $mission->professionnels()->attach($pro->id);
        $mission->particuliers()->attach($part->id);
        //mise a jour du nombre de propositions recue/ envoyee chez tous les part et les usr
        DB::table('professionnels')
            ->update([
                'prop_recue' => DB::raw('(SELECT COUNT(*)
                                   FROM mission_particulier_professionnel mpp
                                   JOIN missions m ON m.id = mpp.mission_id
                                   WHERE mpp.professionnel_id = professionnels.id)')
            ]);
        DB::table('particuliers')
            ->update([
                'prop_mission' => DB::raw('(SELECT COUNT(*)
                                   FROM mission_particulier_professionnel mpp
                                   JOIN missions m ON m.id = mpp.mission_id
                                   WHERE mpp.particulier_id = particuliers.id)')
            ]);
        return to_route('TPA.acceuil_pro',['part'=>$part,'pro'=>$pro])->with('message','Votre mission est desormais en attente ');
    }

    /**
     * CONTROLLER DES OFFRES CHEZ PART ,OFFRE CHEZ PRO ET LISTE DES PRO D'UNE ACTIVITE
     *
     */

    public function mes_offres( particulier $part)
    {
        $missions = Mission::join('mission_particulier_professionnel', 'missions.id', '=', 'mission_particulier_professionnel.mission_id')
            ->where('mission_particulier_professionnel.particulier_id', $part->id)
            ->select('missions.*')
            ->get();
        return view('TPA.Pages.mes_offres')->with(['missions'=>$missions,'part'=>$part]);
    }

    public function mes_offres_recues( professionnel $pro)
    {
        $missions = Mission::join('mission_particulier_professionnel', 'missions.id', '=', 'mission_particulier_professionnel.mission_id')
            ->where('mission_particulier_professionnel.professionnel_id', $pro->id)
            ->select('missions.*')
            ->get();
        return view('TPA.Pages.mes_offres_recue')->with(['missions'=>$missions,'pro'=>$pro]);
    }



    public  function liste_pro(particulier $part  , $fonction )
    {
        $professionnels = professionnel::join('experiences', 'professionnels.id', '=', 'experiences.professionnel_id')
            ->where('experiences.fonction',$fonction)
            ->select('professionnels.*')
            ->get();
        return view('TPA.Pages.liste_pro')->with(['part'=>$part,'pros'=>$professionnels]);
    }

    /**
     * CONTROLLER DES SHOW
     *
     */

    /** SHOW DU PROFESSIONNEL POUR LE PARTICULIER */
    public function pro_show(professionnel $pro,particulier $part )
    {
        /*$collab_number = DB::table('particuliers')
            ->where('id', $part->id)
            ->update([
                'prop_mission' => DB::raw('(SELECT COUNT(*)
                           FROM mission_particulier_professionnel mpp
                           JOIN missions m ON m.id = mpp.mission_id
                           WHERE mpp.particulier_id = ' . $part->id . ' AND mpp.professionnel_id = ' . $pro->id . ')')
            ]);

        $collab_data =  DB::table('particuliers')
            ->where('id', $part->id)
            ->update([
                'prop_mission' => DB::raw('(SELECT *
                           FROM mission_particulier_professionnel mpp
                           JOIN missions m ON m.id = mpp.mission_id
                           WHERE mpp.particulier_id = ' . $part->id . ' AND mpp.professionnel_id = ' . $pro->id . ')')
            ]);*/
        $exps = Experience::join('professionnels', 'professionnels.id', '=', 'experiences.professionnel_id')
            ->where('experiences.professionnel_id',$pro->id)
            ->select('experiences.*')
            ->get();
        return view('TPA.Pages.Show.pro_show')->with(['pro'=>$pro,'part'=>$part,'exps'=>$exps]);
    }
    /**
     *
     *
     * SHOW DU PARTICULIER POUR LE PROFESSIONEL
     */
    public function part_show(professionnel $pro,particulier $part )
    {
       /* $collab_number = DB::table('particuliers')
            ->where('id', $part->id)
            ->update([
                'prop_mission' => DB::raw('(SELECT COUNT(*)
                           FROM mission_particulier_professionnel mpp
                           JOIN missions m ON m.id = mpp.mission_id
                           WHERE mpp.particulier_id = ' . $part->id . ' AND mpp.professionnel_id = ' . $pro->id . ')')
            ]);

        $collab_data =  DB::table('particuliers')
            ->where('id', $part->id)
            ->update([
                'prop_mission' => DB::raw('(SELECT *
                           FROM mission_particulier_professionnel mpp
                           JOIN missions m ON m.id = mpp.mission_id
                           WHERE mpp.particulier_id = ' . $part->id . ' AND mpp.professionnel_id = ' . $pro->id . ')')
            ]);*/
        return view('TPA.Pages.Show.part_show')->with(['pro'=>$pro,'part'=>$part]);
    }
    /** S
     *
     *
     * HOW DE LA MISSION
     */

    PUBLIC function  mission_show()
    {
        return view('TPA.Pages.Show.mission');
    }

    /**
     *
     *
     * SHOW DE L'experience
     */

    PUBLIC function  experience_show()
    {
        return view('TPA.Pages.Show.experience');
    }
}

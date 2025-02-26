<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class InitParticipants extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'init-participants';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = [
            ['felicia21001@mail.unpad.ac.id',	'Felicia Natania Lingga'],
            ['daffa21009@mail.unpad.ac.id',	'Daffa Yusranizar Arrifi'],
            ['varian21001@mail.unpad.ac.id',	'Varian Avila Faldi'],
            ['adinda21002@mail.unpad.ac.id',	'Adinda Salsabila'],
            ['chienta21001@mail.unpad.ac.id',	'Chienta Fleury M'],
            ['fakhri21001@mail.unpad.ac.id',	'Fakhri Fajar Ramadhan'],
            ['prames21001@mail.unpad.ac.id',	'Prames Ray Lapian'],
            ['hermanu21001@mail.unpad.ac.id',	'Hermanu Widyatama'],
            ['dandyaryaputra@gmail.com',	'Dandy Erlangga Aryaputra'],
            ['chairal21001@mail.unpad.ac.id',	'Chairal Octavyanz Tanjung'],
            ['muhammad21019@mail.unpad.ac.id',	'Muhammad Giat'],
            ['ken21001@mail.unpad.ac.id',	'Ken Almayda Fathurrahman'],
            ['muhammad21234@mail.unpad.ac.id',	'Muhammad Rakha Al Rovi'],
            ['mohammad21005@mail.unpad.ac.id',	'Mohammad Zidan Yohanza'],
            ['abdul23002@mail.unpad.ac.id', 'Abdul Aziz Rantizi'],
            ['adnansinatria10@gmail.com', 'Adnan Hafizh Sinatria'],
            ['aidan23002@mail.unpad.ac.id', 'Aidan Ismail'],
            ['alfarisy23001@mail.unpad.ac.id', 'Alfarisy Nafaro Gymnastiar'],
            ['alissa.indraputri@gmail.com', 'Alissa Indraputri'],
            ['ammara23004@gmail.com', 'Ammara Azwadiena Alfiantie'],
            ['athallah.rahza@gmail.com', 'Athallah Azhar Aulia Hadi'],
            ['atharikputraa@gmail.com', 'Atharik Putra Rajendra'],
            ['bagas23003@maill.unpad.ac.id', 'Bagas Diatama Wardoyo'],
            ['bimyusufkarang21@gmail.com', 'Bim Yusuf Karang'],
            ['bunga05adlyna@gmail.com', 'Bunga Adlyna Windasari'],
            ['adelineclarisya@gmail.com', 'Clarisya Adeline'],
            ['dafa23002@mail.unpad.ac.id', 'Dafa Ghani Abdul Rabbani'],
            ['danish23003@mail.unpad.ac.id', 'Danish Rahadian Mirza Effendi'],
            ['darrenliharja@gmail.com', 'Darren Christian Liharja'],
            ['devi22002@mail.unpad.ac.id', 'Devi Humaira'],
            ['kevin.ameliano@gmail.com', 'Drias Ameliano Kevin David'],
            ['dylan22001@mail.unpad.ac.id', 'Dylan Amadeus'],
            ['dzulfadlul23001@mail.unpad.ac.id', 'Dzulfadlul'],
            ['eusthachiusrivan@gmail.com', 'Eusthachius Rivan Verianto Norel'],
            ['fahri22002@mail.unpad.ac.id', 'Fahri Nizar Argubi'],
            ['faizzani22001@mail.unpad.ac.id', 'Faizzani Zingsky Pratiwi'],
            ['giast22001@mail.unpad.ac.id', 'Giast Ahmad'],
            ['gunawan23001@mail.unpad.ac.id', 'Gunawan Sabili Rohman'],
            ['hafizh23006@mail.unpad.ac.id', 'Hafizh Fadhl Muhammad'],
            ['hanna23006@mail.unpad.ac.id', 'Hanna Evelyn Gultom'],
            ['imam22003@mail.unpad.ac.id', 'Imam Farrel Rayhandita Soetardjo Prabowo'],
            ['msjason17@gmail.com', 'Jason Natanael Krisyanto'],
            ['jeffrey23001@mail.unpad.ac.id', 'Jeffrey Septian Tuan Lavit Mahulae'],
            ['nwjonathan96@gmail.com', 'Jonathan Nugroho Adhi Wicaksono'],
            ['josefharveymangaratua@gmail.com', 'Josef Harvey Mangaratua'],
            ['louis.sung24@gmail.com', 'Louis Koni Sung'],
            ['luthfi23001@mail.unpad.ac.id', 'Luthfi Hamam Arsyada'],
            ['marciano.lie.24@gmail.com', 'Marciano Lie'],
            ['michael23002@mail.unpad.ac.id', 'Michael Christianto'],
            ['michaelj.sianipar@gmail.com', 'Michael Jordan Alfanius Sianipar'],
            ['mhafizfenaldhie2904@gmail.com', 'Muhammad Hafizh Fenaldi'],
            ['milhamsyahr22001@gmail.com', 'Muhammad Ilhamsyah R'],
            ['azizluthfi8@gmail.com', 'Muhammad Luthfi Aziz Sunarya'],
            ['nefrit1208@gmail.com', 'Muhammad Nefrit Mahardika'],
            ['rizkiputra2626@gmail.com', 'Muhammad Rizki Putra'],
            ['muhammad22015@mail.unpad.ac.id', 'Muhammad Wildan Kamil'],
            ['zahranmuntazar17@gmail.com', 'Muhammad Zahran Muntazar'],
            ['arzetta1997@gmail.com', 'Nabila Rahmanisa Putri Arzetta'],
            ['nada23004@mail.unpad.ac.id', 'Nada Ghaisani Hasyim'],
            ['nadia22002@mail.unpad.ac.id', 'Nadia Mulyadi'],
            ['nurkahfirahmada@gmail.com', 'Nurkahfi Amran Rahmada'],
            ['panji22001@mail.unpad.ac.id', 'Panji Iman Sujatmiko'],
            ['rafa22001@mail.unpad.ac.id', 'Rafa Agustant'],
            ['rais22002@mail.unpad.ac.id', 'Rais abiyyu putra'],
            ['rayhan22008@mail.unpad.ac.id', 'Rayhan Nugrah Kristio'],
            ['reghina22001@mail.unpad.ac.id', 'Reghina Maisarah'],
            ['reymontha22001@mail.unpad.ac.id', 'Reymontha Tarigan'],
            ['risya22001@mail.unpad.ac.id', 'Risya Annisa\' Chairyah'],
            ['rynad23001@mail.unpad.ac.id', 'Rynad Arkansyah Gunawan'],
            ['sanjukin22001@mail.unpad.ac.id', 'Sanjukin Pinem'],
            ['shaka22002@mail.unpad.ac.id', 'Shaka Reyhan Saputra'],
            ['shervina22001@mail.unpad.ac.id', 'Shervina Ananda Hardellya'],
            ['stevanusf77@gmail.com', 'Stevanus Felixiano'],
            ['tabina22001@mail.unpad.ac.id', 'Tabina adelia rafa'],
            ['tegar.juntak@gmail.com', 'Tegar Posma Diaz Simanjuntak'],
            ['ode23001@mail.unpad.ac.id', 'Wa Ode Zachra Chaerani'],
        ];

        DB::transaction(static function () use ($users) {

            foreach ($users as $user) {
                [$email, $name] = $user;
                $password = Hash::make('S4ltedCaramel(^.^)');

                User::createOrFirst(compact('email'), compact('email', 'name', 'password'))
                    ->markEmailAsVerified();

            }
//

        });
    }
}

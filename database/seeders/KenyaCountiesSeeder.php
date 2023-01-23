<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KenyaCountiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('kenya_counties')->delete();

        $counties = array(
            array('code' => '001', 'name' => 'Mombasa', 'headquaters' => 'Mombasa'),
            array('code' => '002', 'name' => 'Kwale', 'headquaters' => 'Kwale'),
            array('code' => '003', 'name' => 'Kilifi', 'headquaters' => 'Kilifi'),
            array('code' => '004', 'name' => 'Tana River', 'headquaters' => 'Hola'),
            array('code' => '005', 'name' => 'Lamu', 'headquaters' => 'Lamu'),
            array('code' => '006', 'name' => 'Taita Taveta', 'headquaters' => 'Taita Taveta'),
            array('code' => '007', 'name' => 'Garissa', 'headquaters' => ' Garissa'),
            array('code' => ' 008', 'name' => ' Wajir', 'headquaters' => ' Wajir'),
            array('code' => ' 009', 'name' => ' Mandera', 'headquaters' => ' Mandera'),
            array('code' => ' 010', 'name' => ' Marsabit', 'headquaters' => ' Marsabit'),
            array('code' => ' 011', 'name' => ' Isiolo', 'headquaters' => ' Isiolo '),
            array('code' => '012:', 'name' => 'Meru', 'headquaters' => ' Meru '),
            array('code' => '013:', 'name' => 'Tharaka Nithi', 'headquaters' => ' Kathwana'),
            array('code' => ' 014', 'name' => ' Embu', 'headquaters' => ' Embu '),
            array('code' => '015:', 'name' => 'Kitui', 'headquaters' => ' Kitui '),
            array('code' => '016:', 'name' => 'Machakos', 'headquaters' => ' Machakos '),
            array('code' => '017:', 'name' => 'Makueni', 'headquaters' => ' Wote '),
            array('code' => '018:', 'name' => 'Nyandarua', 'headquaters' => ' Ol Kalou'),
            array('code' => ' 019', 'name' => ' Nyeri', 'headquaters' => ' Nyeri '),
            array('code' => '020:', 'name' => 'Kirinyaga', 'headquaters' => ' Kerugoya '),
            array('code' => '021:', 'name' => 'Murang’a', 'headquaters' => ' Murang’a'),
            array('code' => '022:', 'name' => 'Kiambu', 'headquaters' => ' Kiambu'),
            array('code' => '023:', 'name' => 'Turkana', 'headquaters' => ' Lodwar '),
            array('code' => '024:', 'name' => 'West Pokot', 'headquaters' => ' Kepenguria '),
            array('code' => '025:', 'name' => 'Samburu', 'headquaters' => ' Maralal '),
            array('code' => '026:', 'name' => 'Trans-Nzoia', 'headquaters' => ' Kitale '),
            array('code' => '027:', 'name' => 'Uasin Gisshu', 'headquaters' => ' Eldoret '),
            array('code' => '028:', 'name' => 'Elgeyo Marakwet', 'headquaters' => ' Iten '),
            array('code' => '029:', 'name' => 'Nandi', 'headquaters' => ' Kapsabet '),
            array('code' => '030:', 'name' => 'Baringo', 'headquaters' => ' Karbanet '),
            array('code' => '031:', 'name' => 'Laikipia', 'headquaters' => ' Rumuruti '),
            array('code' => '032:', 'name' => 'Nakuru', 'headquaters' => ' Nakuru '),
            array('code' => '033:', 'name' => 'Narok', 'headquaters' => ' Narok '),
            array('code' => '034:', 'name' => 'Kajiado', 'headquaters' => ' Kajiado '),
            array('code' => '035:', 'name' => 'Kericho', 'headquaters' => ' Kericho '),
            array('code' => '036:', 'name' => 'Bomet', 'headquaters' => ' Bomet '),
            array('code' => '037:', 'name' => 'Kakamega', 'headquaters' => ' Kakamega '),
            array('code' => '038:', 'name' => 'Vihiga', 'headquaters' => ' Vihiga '),
            array('code' => '039:', 'name' => 'Bungoma', 'headquaters' => ' Bungoma '),
            array('code' => '040:', 'name' => 'Busia', 'headquaters' => ' Busia '),
            array('code' => '041:', 'name' => 'Siaya', 'headquaters' => ' Siaya '),
            array('code' => '042:', 'name' => 'Kisumu', 'headquaters' => ' Kisumu '),
            array('code' => '043:', 'name' => 'Homa Bay', 'headquaters' => ' Homa Bay '),
            array('code' => '044:', 'name' => 'Migori', 'headquaters' => ' Migori '),
            array('code' => '045:', 'name' => 'Kisii', 'headquaters' => ' Kisii '),
            array('code' => '046:', 'name' => 'Nyamira', 'headquaters' => ' Nyamira '),
            array('code' => '047:', 'name' => 'Nairobi', 'headquaters' => 'Nairobi'),
        );

        DB::table('kenya_counties')->insert($counties);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HidupanLiar;
use Carbon\Carbon;

class HidupanLiarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['NAMA_TEMPATAN'=>'Badak Sumatra','NAMA_SAINTIFIK'=>'(Dicerorhinus sumatrensis)'],
            ['NAMA_TEMPATAN'=>'Beruang Madu','NAMA_SAINTIFIK'=>'(Helarctos malayanus)'],
            ['NAMA_TEMPATAN'=>'Monyet Bangkatan','NAMA_SAINTIFIK'=>'(Nasalis larvatus)'],
            ['NAMA_TEMPATAN'=>'Orang Utan','NAMA_SAINTIFIK'=>'(Pongo pygmaeus)'],
            ['NAMA_TEMPATAN'=>'Duyung','NAMA_SAINTIFIK'=>'(Dugong dugon)'],
            ['NAMA_TEMPATAN'=>'Harimau Dahan','NAMA_SAINTIFIK'=>'(Neofelis nebulosa)'],
            ['NAMA_TEMPATAN'=>'Buaya Julung-julung','NAMA_SAINTIFIK'=>'(Tomistoma schlegeli)'],
            ['NAMA_TEMPATAN'=>'Penyu Sisik','NAMA_SAINTIFIK'=>'(Eretmochelys imbricata)'],
            ['NAMA_TEMPATAN'=>'Penyu Hijau','NAMA_SAINTIFIK'=>'(Chelonia mydas)'],
            ['NAMA_TEMPATAN'=>'Cencurut Kinabalu','NAMA_SAINTIFIK'=>'(Crocidura baluensis)'],
            ['NAMA_TEMPATAN'=>'Kelawar Ladam-bulat Dayak','NAMA_SAINTIFIK'=>'(Hipposideros dyacoru)'],
            ['NAMA_TEMPATAN'=>'Kelawar Hidung Pendek Tembaga','NAMA_SAINTIFIK'=>'(Pipistrellus cuprosus)'],
            ['NAMA_TEMPATAN'=>'Kelawar Hidung Laras Emas','NAMA_SAINTIFIK'=>'(Murina rozendaali)'],
            ['NAMA_TEMPATAN'=>'Kubung','NAMA_SAINTIFIK'=>'(Cynocephalus variegatus)'],
            ['NAMA_TEMPATAN'=>'Kongkang','NAMA_SAINTIFIK'=>'(Nycticebus coucang)'],
            ['NAMA_TEMPATAN'=>'Kera Hantu','NAMA_SAINTIFIK'=>'(Tarsius bancanus)'],
            ['NAMA_TEMPATAN'=>'Monyet Merah','NAMA_SAINTIFIK'=>'(Presbytis rubicunda)'],
            ['NAMA_TEMPATAN'=>'Monyet Kikok','NAMA_SAINTIFIK'=>'(Presbytis hosei)'],
            ['NAMA_TEMPATAN'=>'Monyet Kelabu','NAMA_SAINTIFIK'=>'(Presbytis cristata)'],
            ['NAMA_TEMPATAN'=>'Kera','NAMA_SAINTIFIK'=>'(Macaca fascicularis)'],
            ['NAMA_TEMPATAN'=>'Beruk','NAMA_SAINTIFIK'=>'(Macaca nemestrina)'],
            ['NAMA_TEMPATAN'=>'Kelawat','NAMA_SAINTIFIK'=>'(Hylobates muelleri)'],
            ['NAMA_TEMPATAN'=>'Tenggiling','NAMA_SAINTIFIK'=>'(Manis javanica)'],
            ['NAMA_TEMPATAN'=>'Tupai Kerawak Putih-kuning','NAMA_SAINTIFIK'=>'(Ratufa affinis)'],
            ['NAMA_TEMPATAN'=>'Tupai Kinabalu','NAMA_SAINTIFIK'=>'(Callosciurus baluensis)'],
            ['NAMA_TEMPATAN'=>'Babut','NAMA_SAINTIFIK'=>'(Rheithrosciurus macrotis)'],
            ['NAMA_TEMPATAN'=>'Tupai Terbang Kecil','NAMA_SAINTIFIK'=>'(Petaurillus hosei)'],
            ['NAMA_TEMPATAN'=>'Tupai Terbang Dada Putih','NAMA_SAINTIFIK'=>'(Petinomys setosus)'],
            ['NAMA_TEMPATAN'=>'Tupai Terbang Ekor Merah','NAMA_SAINTIFIK'=>'(Iomys horsfieldi)'],
            ['NAMA_TEMPATAN'=>'Tupai Terbang Pipi Kelabu','NAMA_SAINTIFIK'=>'(Hylopetes lepidus)'],
            ['NAMA_TEMPATAN'=>'Tupai Terbang Hitam','NAMA_SAINTIFIK'=>'(Aeromys tephromelas)'],
            ['NAMA_TEMPATAN'=>'Tupai Terbang Kotor','NAMA_SAINTIFIK'=>'(Pteromyscus pulverulentus)'],
            ['NAMA_TEMPATAN'=>'Tupai Terbang Berjambang','NAMA_SAINTIFIK'=>'(Petinomys genibarbis)'],
            ['NAMA_TEMPATAN'=>'Tupai Terbang Bintang','NAMA_SAINTIFIK'=>'(Petaurista elegans)'],
            ['NAMA_TEMPATAN'=>'Tupai Terbang Merah','NAMA_SAINTIFIK'=>'(Petaurista petaurista)'],
            ['NAMA_TEMPATAN'=>'Tupai Terbang Merah','NAMA_SAINTIFIK'=>'(Aeromys thomasi)'],
            ['NAMA_TEMPATAN'=>'Landak Padi','NAMA_SAINTIFIK'=>'(Trichys fasciculata)'],
            ['NAMA_TEMPATAN'=>'Landak Borneo','NAMA_SAINTIFIK'=>'(Thecurus crassispinis)'],
            ['NAMA_TEMPATAN'=>'Mengkira','NAMA_SAINTIFIK'=>'(Martes flavigula)'],
            ['NAMA_TEMPATAN'=>'Pulasan Tanah','NAMA_SAINTIFIK'=>'(Mustela nudipes)'],
            ['NAMA_TEMPATAN'=>'Pulasan Lamri','NAMA_SAINTIFIK'=>'(Melogale personata)'],
            ['NAMA_TEMPATAN'=>'Teledu','NAMA_SAINTIFIK'=>'(Mydaus javanensis)'],
            ['NAMA_TEMPATAN'=>'Memerang Kumis','NAMA_SAINTIFIK'=>'(Lutra sumatrana)'],
            ['NAMA_TEMPATAN'=>'Memerang Licin','NAMA_SAINTIFIK'=>'(Lutra perspicillata)'],
            ['NAMA_TEMPATAN'=>'Memerang Kecil','NAMA_SAINTIFIK'=>'(Aonyx cinerea)'],
            ['NAMA_TEMPATAN'=>'Musang Tanggalong','NAMA_SAINTIFIK'=>'(Viverra tangalunga)'],
            ['NAMA_TEMPATAN'=>'Musang Memerang','NAMA_SAINTIFIK'=>'(Cynogale bennettii)'],
            ['NAMA_TEMPATAN'=>'Musang Binturong','NAMA_SAINTIFIK'=>'(Arctictis binturong)'],
            ['NAMA_TEMPATAN'=>'Musang Akar','NAMA_SAINTIFIK'=>'(Arctogalidia trivirgata)'],
            ['NAMA_TEMPATAN'=>'Musang Lamri','NAMA_SAINTIFIK'=>'(Paguma larvata)'],
            ['NAMA_TEMPATAN'=>'Musang Pulut','NAMA_SAINTIFIK'=>'(Paradoxurus hermaphroditus)'],
            ['NAMA_TEMPATAN'=>'Musang Hitam Pudar','NAMA_SAINTIFIK'=>'(Hemigalus hosei)'],
            ['NAMA_TEMPATAN'=>'Musang Belang','NAMA_SAINTIFIK'=>'(Hemigalus derbyanus)'],
            ['NAMA_TEMPATAN'=>'Musang Linsang','NAMA_SAINTIFIK'=>'(Prionodon linsang)'],
            ['NAMA_TEMPATAN'=>'Bambun Ekor Panjang','NAMA_SAINTIFIK'=>'(Herpestes semitorquatus)'],
            ['NAMA_TEMPATAN'=>'Bambun Ekor Pendek','NAMA_SAINTIFIK'=>'(Herpestes brachyurus)'],
            ['NAMA_TEMPATAN'=>'Kucing Batu','NAMA_SAINTIFIK'=>'(Felis bengalensis)'],
            ['NAMA_TEMPATAN'=>'Kucing Dahan','NAMA_SAINTIFIK'=>'(Felis marmorata)'],
            ['NAMA_TEMPATAN'=>'Kucing Hutan','NAMA_SAINTIFIK'=>'(Felis planiceps)'],
            ['NAMA_TEMPATAN'=>'Kucing Merah','NAMA_SAINTIFIK'=>'(Felis badia)'],
            ['NAMA_TEMPATAN'=>'Gajah','NAMA_SAINTIFIK'=>'(Elephas maximus)'],
            ['NAMA_TEMPATAN'=>'Tembadau','NAMA_SAINTIFIK'=>'(Bos javanicus)'],
            ['NAMA_TEMPATAN'=>'Okan Paus Sei','NAMA_SAINTIFIK'=>'(Balanopthera borealis)'],
            ['NAMA_TEMPATAN'=>'Ikan Paus Bryde','NAMA_SAINTIFIK'=>'(Balanoptera edent)'],
            ['NAMA_TEMPATAN'=>'Ikan Paus Buding','NAMA_SAINTIFIK'=>'(Orcinus orca)'],
            ['NAMA_TEMPATAN'=>'Ikan Paus Pendek Sirip','NAMA_SAINTIFIK'=>'(Globicephala macrorhynchus)'],
            ['NAMA_TEMPATAN'=>'Ikan Paus Nayan','NAMA_SAINTIFIK'=>'(Kogia breviceps)'],
            ['NAMA_TEMPATAN'=>'Dolfin Kelabu','NAMA_SAINTIFIK'=>'(Grampus griseus)'],
            ['NAMA_TEMPATAN'=>'Dolfin Hidung Botol','NAMA_SAINTIFIK'=>'(Tursiops truncatus)'],
            ['NAMA_TEMPATAN'=>'Dolfin Bengkok Bernie','NAMA_SAINTIFIK'=>'(Sousa chinensis)'],
            ['NAMA_TEMPATAN'=>'Dolphin Empesut','NAMA_SAINTIFIK'=>'(Orcaella brevirostris)'],
            ['NAMA_TEMPATAN'=>'Ikan Lumba-lumba Ambu','NAMA_SAINTIFIK'=>'(Neophocaena phocaenides)'],
            ['NAMA_TEMPATAN'=>'Dolfin Fraser','NAMA_SAINTIFIK'=>'(Lagenodelhis hosei)'],
            ['NAMA_TEMPATAN'=>'Dolfin Hidung Mancung','NAMA_SAINTIFIK'=>'(Stenella longirostra)'],
            ['NAMA_TEMPATAN'=>'Kupu-Kupu Rajah','NAMA_SAINTIFIK'=>'(Trogonoptera brookiana)'],
            ['NAMA_TEMPATAN'=>'Kupu-Kupu','NAMA_SAINTIFIK'=>'(All troides species)'],
            ['NAMA_TEMPATAN'=>'Biawak','NAMA_SAINTIFIK'=>'(All varanus species)'],
            ['NAMA_TEMPATAN'=>'Ular Sawah Darah','NAMA_SAINTIFIK'=>'(Python curtus)'],
            ['NAMA_TEMPATAN'=>'Ular Tedung Selar','NAMA_SAINTIFIK'=>'(Ophiophagus hannah)'],
            ['NAMA_TEMPATAN'=>'Kura-kura Bukit','NAMA_SAINTIFIK'=>'(Tetsudo emys)'],
            ['NAMA_TEMPATAN'=>'Buaya','NAMA_SAINTIFIK'=>'(Crocodylus porosus)'],
            ['NAMA_TEMPATAN'=>'Ular Sawa Panjang','NAMA_SAINTIFIK'=>'(Python reticulatus)'],
            ['NAMA_TEMPATAN'=>'Juku-juku Besar','NAMA_SAINTIFIK'=>'(Orlitia borneonsis)'],
            ['NAMA_TEMPATAN'=>'Keluang Bakau','NAMA_SAINTIFIK'=>'(Pteropus vampyrus)'],
            ['NAMA_TEMPATAN'=>'Landak Raya','NAMA_SAINTIFIK'=>'(Hystrix brachyura)'],
            ['NAMA_TEMPATAN'=>'Pelanduk','NAMA_SAINTIFIK'=>'(Tragulus javanicus)'],
            ['NAMA_TEMPATAN'=>'Kijang','NAMA_SAINTIFIK'=>'(Muntiacus muntjac)'],
            ['NAMA_TEMPATAN'=>'Keluang Pulau','NAMA_SAINTIFIK'=>'(Pteropus hypomelanuss)'],
            ['NAMA_TEMPATAN'=>'Babi Hutan','NAMA_SAINTIFIK'=>'(Sus barbatus)'],
            ['NAMA_TEMPATAN'=>'Napoh','NAMA_SAINTIFIK'=>'(Tragulus napu)'],
            ['NAMA_TEMPATAN'=>'Kijang','NAMA_SAINTIFIK'=>'(Muntiacus atherodes)'],
            ['NAMA_TEMPATAN'=>'Rusa','NAMA_SAINTIFIK'=>'(Cervus unicolor)'],
            ['NAMA_TEMPATAN'=>'Periuk Kera','NAMA_SAINTIFIK'=>'Nepenthes rajah'],
            ['NAMA_TEMPATAN'=>'Orkid Selipar','NAMA_SAINTIFIK'=>'Paphiopedilum spp'],
            ['NAMA_TEMPATAN'=>'Rafflesia','NAMA_SAINTIFIK'=>'Rafflesia spp'],
            ['NAMA_TEMPATAN'=>'Pokok Perumah Rafflesia','NAMA_SAINTIFIK'=>'Tetrastigma spp'],
            ['NAMA_TEMPATAN'=>'Botu','NAMA_SAINTIFIK'=>'Caryota spp'],
            ['NAMA_TEMPATAN'=>'Rotan','NAMA_SAINTIFIK'=>'Ceratolobus spp'],
            ['NAMA_TEMPATAN'=>'Gebang','NAMA_SAINTIFIK'=>'Corypha spp'],
            ['NAMA_TEMPATAN'=>'Paku Laut','NAMA_SAINTIFIK'=>'Cycadaceae'],
            ['NAMA_TEMPATAN'=>'Paku','NAMA_SAINTIFIK'=>'Cytoceae'],
            ['NAMA_TEMPATAN'=>'Polod','NAMA_SAINTIFIK'=>'Arenga sp'],
            ['NAMA_TEMPATAN'=>'Periuk Kera','NAMA_SAINTIFIK'=>'Nepenthaceae'],
            ['NAMA_TEMPATAN'=>'Anggerek Hutan','NAMA_SAINTIFIK'=>'Orchidaceae'],
            ['NAMA_TEMPATAN'=>'Lampias','NAMA_SAINTIFIK'=>'Podocarpus (Commercial spp)'],
            ['NAMA_TEMPATAN'=>'Silad','NAMA_SAINTIFIK'=>'Livistonia sp'],
            ['NAMA_TEMPATAN'=>'Mawar Hutan','NAMA_SAINTIFIK'=>'Rhododendron spp'],
            ['NAMA_TEMPATAN'=>'Halia Hutan','NAMA_SAINTIFIK'=>'Zingiberaceae'],
            ['NAMA_TEMPATAN'=>'Pinang Hutan','NAMA_SAINTIFIK'=>'Nanga spp.'],

        ];

        HidupanLiar::insert($data);
    }
}
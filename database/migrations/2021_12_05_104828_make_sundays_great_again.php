<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeSundaysGreatAgain extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::dropIfExists('sundays');

        Schema::create('sundays', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->boolean('sunday')->default(1);
        });

        $sundays = [
            [
                'date' => '2018-07-08',
                'sunday' => 1
            ],
            [
                'date' => '2018-07-15',
                'sunday' => 0
            ],
            [
                'date' => '2018-07-22',
                'sunday' => 1
            ],
            [
                'date' => '2018-08-12',
                'sunday' => 1
            ],
            [
                'date' => '2018-08-15',
                'sunday' => 1
            ],
            [
                'date' => '2018-08-19',
                'sunday' => 1
            ],
            [
                'date' => '2018-09-09',
                'sunday' => 1
            ],
            [
                'date' => '2018-09-16',
                'sunday' => 1
            ],
            [
                'date' => '2018-09-23',
                'sunday' => 1
            ],
            [
                'date' => '2018-10-14',
                'sunday' => 1
            ],
            [
                'date' => '2018-10-21',
                'sunday' => 1
            ],
            [
                'date' => '2018-11-01',
                'sunday' => 0
            ],
            [
                'date' => '2018-11-11',
                'sunday' => 1
            ],
            [
                'date' => '2018-11-18',
                'sunday' => 1
            ],
            [
                'date' => '2018-12-09',
                'sunday' => 1
            ],
            [
                'date' => '2018-12-25',
                'sunday' => 0
            ],
            [
                'date' => '2018-12-26',
                'sunday' => 0
            ],
            [
                'date' => '2019-01-01',
                'sunday' => 0
            ],
            [
                'date' => '2019-01-06',
                'sunday' => 1
            ],
            [
                'date' => '2019-01-13',
                'sunday' => 1
            ],
            [
                'date' => '2019-01-20',
                'sunday' => 1
            ],
            [
                'date' => '2019-02-03',
                'sunday' => 1
            ],
            [
                'date' => '2019-02-10',
                'sunday' => 1
            ],
            [
                'date' => '2019-02-17',
                'sunday' => 1
            ],
            [
                'date' => '2019-03-03',
                'sunday' => 1
            ],
            [
                'date' => '2019-03-10',
                'sunday' => 1
            ],
            [
                'date' => '2019-03-17',
                'sunday' => 1
            ],
            [
                'date' => '2019-03-24',
                'sunday' => 1
            ],
            [
                'date' => '2019-04-07',
                'sunday' => 1
            ],
            [
                'date' => '2019-04-21',
                'sunday' => 1
            ],
            [
                'date' => '2019-04-22',
                'sunday' => 0
            ],
            [
                'date' => '2019-05-01',
                'sunday' => 0
            ],
            [
                'date' => '2019-05-03',
                'sunday' => 0
            ],
            [
                'date' => '2019-05-05',
                'sunday' => 1
            ],
            [
                'date' => '2019-05-12',
                'sunday' => 1
            ],
            [
                'date' => '2019-05-19',
                'sunday' => 1
            ],
            [
                'date' => '2019-06-02',
                'sunday' => 1
            ],
            [
                'date' => '2019-06-09',
                'sunday' => 1
            ],
            [
                'date' => '2019-06-16',
                'sunday' => 1
            ],
            [
                'date' => '2019-06-20',
                'sunday' => 0
            ],
            [
                'date' => '2019-06-23',
                'sunday' => 1
            ],
            [
                'date' => '2019-07-07',
                'sunday' => 1
            ],
            [
                'date' => '2019-07-14',
                'sunday' => 1
            ],
            [
                'date' => '2019-07-21',
                'sunday' => 1
            ],
            [
                'date' => '2019-08-04',
                'sunday' => 1
            ],
            [
                'date' => '2019-08-11',
                'sunday' => 1
            ],
            [
                'date' => '2019-08-15',
                'sunday' => 0
            ],
            [
                'date' => '2019-08-18',
                'sunday' => 1
            ],
            [
                'date' => '2019-09-01',
                'sunday' => 1
            ],
            [
                'date' => '2019-09-08',
                'sunday' => 1
            ],
            [
                'date' => '2019-09-15',
                'sunday' => 1
            ],
            [
                'date' => '2019-09-22',
                'sunday' => 1
            ],
            [
                'date' => '2019-10-06',
                'sunday' => 1
            ],
            [
                'date' => '2019-10-13',
                'sunday' => 1
            ],
            [
                'date' => '2019-10-20',
                'sunday' => 1
            ],
            [
                'date' => '2019-11-01',
                'sunday' => 0
            ],
            [
                'date' => '2019-11-03',
                'sunday' => 1
            ],
            [
                'date' => '2019-11-10',
                'sunday' => 1
            ],
            [
                'date' => '2019-11-11',
                'sunday' => 0
            ],
            [
                'date' => '2019-11-17',
                'sunday' => 1
            ],
            [
                'date' => '2019-12-01',
                'sunday' => 1
            ],
            [
                'date' => '2019-12-08',
                'sunday' => 1
            ],
            [
                'date' => '2019-12-25',
                'sunday' => 0
            ],
            [
                'date' => '2019-12-26',
                'sunday' => 0
            ],
            [
                'date' => '2020-01-01',
                'sunday' => 0
            ],
            [
                'date' => '2020-01-05',
                'sunday' => 1
            ],
            [
                'date' => '2020-01-06',
                'sunday' => 0
            ],
            [
                'date' => '2020-01-12',
                'sunday' => 1
            ],
            [
                'date' => '2020-01-19',
                'sunday' => 1
            ],
            [
                'date' => '2020-02-02',
                'sunday' => 1
            ],
            [
                'date' => '2020-02-09',
                'sunday' => 1
            ],
            [
                'date' => '2020-02-16',
                'sunday' => 1
            ],
            [
                'date' => '2020-02-23',
                'sunday' => 1
            ],
            [
                'date' => '2020-03-01',
                'sunday' => 1
            ],
            [
                'date' => '2020-03-08',
                'sunday' => 1
            ],
            [
                'date' => '2020-03-15',
                'sunday' => 1
            ],
            [
                'date' => '2020-03-22',
                'sunday' => 1
            ],
            [
                'date' => '2020-03-29',
                'sunday' => 1
            ],
            [
                'date' => '2020-04-12',
                'sunday' => 1
            ],
            [
                'date' => '2020-04-13',
                'sunday' => 0
            ],
            [
                'date' => '2020-04-19',
                'sunday' => 1
            ],
            [
                'date' => '2020-05-01',
                'sunday' => 1
            ],
            [
                'date' => '2020-05-03',
                'sunday' => 1
            ],
            [
                'date' => '2020-05-10',
                'sunday' => 1
            ],
            [
                'date' => '2020-05-17',
                'sunday' => 1
            ],
            [
                'date' => '2020-05-24',
                'sunday' => 1
            ],
            [
                'date' => '2020-05-31',
                'sunday' => 1
            ],
            [
                'date' => '2020-06-07',
                'sunday' => 1
            ],
            [
                'date' => '2020-06-11',
                'sunday' => 1
            ],
            [
                'date' => '2020-06-14',
                'sunday' => 1
            ],
            [
                'date' => '2020-06-21',
                'sunday' => 1
            ],
            [
                'date' => '2020-07-05',
                'sunday' => 1
            ],
            [
                'date' => '2020-07-12',
                'sunday' => 1
            ],
            [
                'date' => '2020-07-19',
                'sunday' => 1
            ],
            [
                'date' => '2020-07-26',
                'sunday' => 1
            ],
            [
                'date' => '2020-08-02',
                'sunday' => 1
            ],
            [
                'date' => '2020-08-09',
                'sunday' => 1
            ],
            [
                'date' => '2020-08-15',
                'sunday' => 0
            ],
            [
                'date' => '2020-08-16',
                'sunday' => 1
            ],
            [
                'date' => '2020-08-23',
                'sunday' => 1
            ],
            [
                'date' => '2020-09-06',
                'sunday' => 1
            ],
            [
                'date' => '2020-09-13',
                'sunday' => 1
            ],
            [
                'date' => '2020-09-20',
                'sunday' => 1
            ],
            [
                'date' => '2020-09-27',
                'sunday' => 1
            ],
            [
                'date' => '2020-10-04',
                'sunday' => 1
            ],
            [
                'date' => '2020-10-11',
                'sunday' => 1
            ],
            [
                'date' => '2020-10-18',
                'sunday' => 1
            ],
            [
                'date' => '2020-10-25',
                'sunday' => 1
            ],
            [
                'date' => '2020-11-01',
                'sunday' => 1
            ],
            [
                'date' => '2020-11-08',
                'sunday' => 1
            ],
            [
                'date' => '2020-11-11',
                'sunday' => 0
            ],
            [
                'date' => '2020-11-15',
                'sunday' => 1
            ],
            [
                'date' => '2020-11-22',
                'sunday' => 1
            ],
            [
                'date' => '2020-11-29',
                'sunday' => 1
            ],
            [
                'date' => '2020-12-06',
                'sunday' => 1
            ],
            [
                'date' => '2020-12-25',
                'sunday' => 1
            ],
            [
                'date' => '2020-12-26',
                'sunday' => 1
            ],
            [
                'date' => '2020-12-27',
                'sunday' => 1
            ]
        ];

        DB::table('sundays')
            ->insert($sundays);

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sundays');
    }
}

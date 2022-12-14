<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('title')->require();
            $table->mediumText('description')->default('');
            $table->dateTime('startDateTime')->require();
            $table->decimal('latitude', 11, 8)->require();
            $table->decimal('longitude', 11, 8)->require();
            $table->string('fullAddress')->require();
            $table->char('country',3)->require();
            $table->boolean('isTrip')->default(false);
            $table->json('eventTrip')->nullable();
            $table->text('cover')->nullable();
            $table->boolean('private')->default(false);
            $table->foreignIdFor(User::class);
            $table->timestamps();
        });

        DB::table('events')->insert(
            array(
                'uuid' => Str::uuid(),
                "title" => "CCSL",
                "description" => "Le CCSL est un meeting du genre Cars & Coffee destiné à tout passionnés d'automobile ayant lieu tout les 1er dimanche du mois

                Ce situant sur le parking du centre commercial de Signy Centre, il est devenu le point de rencontre incontournable de la région lémanique pour tout les propriétaires de véhicules sportif, de collection ou décalé.
                
                Venez à la rencontre à partir de 9h45 jusqu'au environ de midi !",
                "startDateTime" => new DateTime("2022-12-04 09:30:00"),
                "latitude" => 46.39724100,
                "longitude" => 6.20644300,
                "fullAddress" => "En Fléchère 7A, 1274 Signy-Avenex, Suisse",
                "country" => "ch",
                "private" => false,
                "user_id" => 1,
                "cover" => "https://trello-backgrounds.s3.amazonaws.com/SharedBackground/2400x1600/2982fc7cc04a2e7a76172f52e7877197/photo-1561043845-2f5e09749871.jpg",
                'created_at' => Carbon::now(),
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('login');
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone')->nullable();
            $table->text('about')->nullable();
            $table->boolean('is_admin')->default(0); // Добавил
            //$table->string('role')->default('user');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};


/*

SQLSTATE[42000]: Syntax error or access violation:
1064 You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near
'after `about`, `remember_token` varchar(100) null, `created_at` timestamp null, '
at line 1 (Connection: mysql, SQL: create table `users`
(`id` bigint unsigned not null auto_increment primary key, `login` varchar(255) not null, `firstname` varchar(255)
null, `lastname` varchar(255) null, `email` varchar(255) not null, `email_verified_at` timestamp null, `password` varchar(255)
not null, `phone` varchar(255) null, `about` text null, `is_admin` tinyint(1) not null default '0' after `about`, `remember_token`
varchar(100) null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci')

*/

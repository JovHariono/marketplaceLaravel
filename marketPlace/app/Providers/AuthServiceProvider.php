<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

use App\Models\role_akses;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //Bypass Super Admin
        Gate::before(function ($user, $ability) {
            if ($user->id == 1) {
                return true;
            }
        });

        Gate::define('index-roleakses', function () {
            if (role_akses::where(['nama_controller' => 'RoleAksesController', 'user_id' => auth()->id()])->where('can_index', 1)->first() != null)
                return true;
        });

        //======================Start kategori Controller===============
        Gate::define('index-kategori', function () {
            if (role_akses::where(['nama_controller' => 'CategoryController', 'user_id' => auth()->id()])->where('can_index', 1)->first() != null)
                return true;
        });
        Gate::define('create-kategori', function () {
            if (role_akses::where(['nama_controller' => 'CategoryController', 'user_id' => auth()->id()])->where('can_create', 1)->first() != null)
                return true;
        });
        Gate::define('read-kategori', function () {
            if (role_akses::where(['nama_controller' => 'CategoryController', 'user_id' => auth()->id()])->where('can_read', 1)->first() != null)
                return true;
        });
        Gate::define('edit-kategori', function () {
            if (role_akses::where(['nama_controller' => 'CategoryController', 'user_id' => auth()->id()])->where('can_edit', 1)->first() != null)
                return true;
        });
        Gate::define('delete-kategori', function () {
            if (role_akses::where(['nama_controller' => 'CategoryController', 'user_id' => auth()->id()])->where('can_delete', 1)->first() != null)
                return true;
        });
        //======================End kategori Controller==================

        //======================Start Artikel Controller===============
        Gate::define('index-artikel', function () {
            if (role_akses::where(['nama_controller' => 'ArtikelController', 'user_id' => auth()->id()])->where('can_index', 1)->first() != null)
                return true;
        });
        Gate::define('create-artikel', function () {
            if (role_akses::where(['nama_controller' => 'ArtikelController', 'user_id' => auth()->id()])->where('can_create', 1)->first() != null)
                return true;
        });
        Gate::define('read-artikel', function () {
            if (role_akses::where(['nama_controller' => 'ArtikelController', 'user_id' => auth()->id()])->where('can_read', 1)->first() != null)
                return true;
        });
        Gate::define('edit-artikel', function () {
            if (role_akses::where(['nama_controller' => 'ArtikelController', 'user_id' => auth()->id()])->where('can_edit', 1)->first() != null)
                return true;
        });
        Gate::define('delete-artikel', function () {
            if (role_akses::where(['nama_controller' => 'ArtikelController', 'user_id' => auth()->id()])->where('can_delete', 1)->first() != null)
                return true;
        });
        //======================End artikel Controller==================

        //======================Start kelas Controller===============
        Gate::define('index-kelas', function () {
            if (role_akses::where(['nama_controller' => 'KelasController', 'user_id' => auth()->id()])->where('can_index', 1)->first() != null)
                return true;
        });
        Gate::define('create-kelas', function () {
            if (role_akses::where(['nama_controller' => 'KelasController', 'user_id' => auth()->id()])->where('can_create', 1)->first() != null)
                return true;
        });
        Gate::define('read-kelas', function () {
            if (role_akses::where(['nama_controller' => 'KelasController', 'user_id' => auth()->id()])->where('can_read', 1)->first() != null)
                return true;
        });
        Gate::define('edit-kelas', function () {
            if (role_akses::where(['nama_controller' => 'KelasController', 'user_id' => auth()->id()])->where('can_edit', 1)->first() != null)
                return true;
        });
        Gate::define('delete-kelas', function () {
            if (role_akses::where(['nama_controller' => 'KelasController', 'user_id' => auth()->id()])->where('can_delete', 1)->first() != null)
                return true;
        });
        //======================End kelas Controller==================

        //======================Start report Controller===============
        Gate::define('index-report', function () {
            if (role_akses::where(['nama_controller' => 'ReportPembayaranController', 'user_id' => auth()->id()])->where('can_index', 1)->first() != null)
                return true;
        });
        Gate::define('create-report', function () {
            if (role_akses::where(['nama_controller' => 'ReportPembayaranController', 'user_id' => auth()->id()])->where('can_create', 1)->first() != null)
                return true;
        });
        Gate::define('read-report', function () {
            if (role_akses::where(['nama_controller' => 'ReportPembayaranController', 'user_id' => auth()->id()])->where('can_read', 1)->first() != null)
                return true;
        });
        Gate::define('edit-report', function () {
            if (role_akses::where(['nama_controller' => 'ReportPembayaranController', 'user_id' => auth()->id()])->where('can_edit', 1)->first() != null)
                return true;
        });
        Gate::define('delete-report', function () {
            if (role_akses::where(['nama_controller' => 'ReportPembayaranController', 'user_id' => auth()->id()])->where('can_delete', 1)->first() != null)
                return true;
        });
        //======================End report Controller==================
    }
}

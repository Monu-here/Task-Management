<?php

namespace App\Console\Commands;

use App\Models\CompanyModel;
use App\Models\User;
use Illuminate\Console\Command;

class companyAndSuperAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:company-super-admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to create company and super admin';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $companyName = $this->ask('Enter company name');
        $address = $this->ask('Enter company address');
        $phone_number = $this->ask('Enter company phone number');
        $company = CompanyModel::create([
            'company_name' => $companyName,
            'address' => $address,
            'phone_number' => $phone_number,
        ]);
        $superAdminEmail = $this->ask('Enter super admin email');
        $superAdminPassword = $this->secret('Enter super admin password');
        $superAdmin = User::create([
            'name' => 'SuperAdmin',
            'email' => $superAdminEmail,
            'password' => bcrypt($superAdminPassword),
            'role' => 'super_admin',
            'company_id' => $company->id,
        ]);

        $this->info('Company and Super Admin created successfully!');
        $this->line('Company: ' . $company->company_name);
        $this->line('Super Admin Email: ' . $superAdmin->email);
    }
}

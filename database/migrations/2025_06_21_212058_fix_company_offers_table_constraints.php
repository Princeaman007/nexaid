<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Vérifier si la table company_offers existe
        if (!Schema::hasTable('company_offers')) {
            Schema::create('company_offers', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('company_id')->nullable();
                $table->string('title');
                $table->text('description')->nullable();
                $table->string('location')->nullable();
                $table->decimal('salary_amount', 8, 2)->nullable();
                $table->date('start_date')->nullable();
                $table->date('end_date')->nullable();
                $table->boolean('remote_possible')->default(false);
                $table->json('required_skills')->nullable();
                $table->enum('status', ['draft', 'published', 'closed', 'archived'])->default('draft');
                $table->timestamp('published_at')->nullable();
                $table->timestamps();

                // Index sans contraintes pour l'instant
                $table->index(['status']);
                $table->index(['company_id']);
                $table->index(['published_at']);
            });
        }

        // 2. Vérifier si la table companies existe
        if (!Schema::hasTable('companies')) {
            Schema::create('companies', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('email')->unique();
                $table->string('phone')->nullable();
                $table->string('website')->nullable();
                $table->text('address')->nullable();
                $table->text('description')->nullable();
                $table->integer('team_size')->nullable();
                $table->enum('status', ['pending', 'active', 'inactive'])->default('pending');
                $table->enum('type', ['hiring', 'partnership', 'offer_sender'])->nullable();
                $table->timestamps();

                $table->index(['status', 'type']);
            });
        }

        // 3. Ajouter les colonnes manquantes à company_offers si nécessaire
        Schema::table('company_offers', function (Blueprint $table) {
            if (!Schema::hasColumn('company_offers', 'location')) {
                $table->string('location')->nullable()->after('description');
            }
            if (!Schema::hasColumn('company_offers', 'salary_amount')) {
                $table->decimal('salary_amount', 8, 2)->nullable()->after('location');
            }
            if (!Schema::hasColumn('company_offers', 'start_date')) {
                $table->date('start_date')->nullable()->after('salary_amount');
            }
            if (!Schema::hasColumn('company_offers', 'end_date')) {
                $table->date('end_date')->nullable()->after('start_date');
            }
            if (!Schema::hasColumn('company_offers', 'remote_possible')) {
                $table->boolean('remote_possible')->default(false)->after('end_date');
            }
            if (!Schema::hasColumn('company_offers', 'required_skills')) {
                $table->json('required_skills')->nullable()->after('remote_possible');
            }
            if (!Schema::hasColumn('company_offers', 'published_at')) {
                $table->timestamp('published_at')->nullable()->after('status');
            }
        });

        // 4. Ajouter la contrainte de clé étrangère seulement si elle n'existe pas
        $this->addForeignKeyIfNotExists();
    }

    public function down(): void
    {
        // Supprimer la contrainte de clé étrangère si elle existe
        $this->dropForeignKeyIfExists();
        
        Schema::dropIfExists('company_offers');
    }

    private function addForeignKeyIfNotExists(): void
    {
        // Vérifier si la contrainte existe déjà
        $foreignKeys = $this->getForeignKeys('company_offers');
        
        $constraintExists = collect($foreignKeys)->contains(function ($fk) {
            return $fk->COLUMN_NAME === 'company_id' && $fk->REFERENCED_TABLE_NAME === 'companies';
        });

        if (!$constraintExists && Schema::hasTable('companies')) {
            try {
                Schema::table('company_offers', function (Blueprint $table) {
                    $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
                });
            } catch (\Exception $e) {
                // Si la contrainte existe déjà, on ignore l'erreur
                if (!str_contains($e->getMessage(), 'Duplicate foreign key constraint')) {
                    throw $e;
                }
            }
        }
    }

    private function dropForeignKeyIfExists(): void
    {
        $foreignKeys = $this->getForeignKeys('company_offers');
        
        foreach ($foreignKeys as $fk) {
            if ($fk->COLUMN_NAME === 'company_id') {
                try {
                    Schema::table('company_offers', function (Blueprint $table) use ($fk) {
                        $table->dropForeign([$fk->COLUMN_NAME]);
                    });
                } catch (\Exception $e) {
                    // Ignorer si la contrainte n'existe pas
                }
            }
        }
    }

    private function getForeignKeys(string $table): array
    {
        $database = config('database.connections.mysql.database');
        
        return DB::select("
            SELECT 
                COLUMN_NAME,
                CONSTRAINT_NAME,
                REFERENCED_TABLE_NAME,
                REFERENCED_COLUMN_NAME
            FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE 
            WHERE 
                TABLE_SCHEMA = ? 
                AND TABLE_NAME = ? 
                AND REFERENCED_TABLE_NAME IS NOT NULL
        ", [$database, $table]);
    }
};
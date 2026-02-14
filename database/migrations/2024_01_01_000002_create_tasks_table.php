<?php

use App\Enums\TaskPosition;
use App\Enums\TaskPriority;
use App\Enums\TaskStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->enum('status', TaskStatus::values())->default(TaskStatus::Pending->value);
            $table->date('end_date')->nullable();
            $table->timestamp('end_date_updated')->nullable();
            $table->enum('priority', TaskPriority::values())->default(TaskPriority::Low->value);
            $table->enum('position', TaskPosition::values())->default(TaskPosition::All->value);
            $table->foreignId('user_id')->nullable()->constrained('users')->restrictOnDelete();
            $table->foreignId('created_by')->constrained('users')->restrictOnDelete();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};

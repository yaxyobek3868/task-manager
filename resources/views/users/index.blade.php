@extends('layouts.app')

@section('title', 'Foydalanuvchilarni boshqarish')

@push('styles')
    <style>
        .page-header {
            margin-bottom: 2.5rem;
            animation: fadeInDown 0.6s ease;
        }

        .page-header h1 {
            font-size: 2rem;
            font-weight: 800;
            color: var(--dark-color);
            margin-bottom: 0.5rem;
            letter-spacing: -0.02em;
        }

        .page-header p {
            color: #64748b;
            font-size: 1rem;
            font-weight: 500;
        }

        .stats-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            border-radius: 16px;
            padding: 1.75rem;
            border: 1px solid var(--border-color);
            box-shadow: var(--shadow-sm);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            animation: fadeInUp 0.6s ease backwards;
        }

        .stat-card:nth-child(1) { animation-delay: 0.1s; }
        .stat-card:nth-child(2) { animation-delay: 0.2s; }
        .stat-card:nth-child(3) { animation-delay: 0.3s; }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: linear-gradient(180deg, var(--accent-color), transparent);
            opacity: 0;
            transition: opacity 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
            border-color: var(--accent-color);
        }

        .stat-card:hover::before {
            opacity: 1;
        }

        .stat-card.primary { --accent-color: #6366f1; }
        .stat-card.success { --accent-color: #10b981; }
        .stat-card.warning { --accent-color: #f59e0b; }

        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 1rem;
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        .stat-card.primary .stat-icon {
            background: linear-gradient(135deg, #eef2ff, #ddd6fe);
            color: #6366f1;
        }

        .stat-card.success .stat-icon {
            background: linear-gradient(135deg, #d1fae5, #a7f3d0);
            color: #059669;
        }

        .stat-card.warning .stat-icon {
            background: linear-gradient(135deg, #fef3c7, #fde68a);
            color: #d97706;
        }

        .stat-title {
            color: #64748b;
            font-size: 0.875rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .stat-value {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--dark-color);
            line-height: 1;
            letter-spacing: -0.02em;
        }

        .search-box {
            background: white;
            border-radius: 16px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            border: 1px solid var(--border-color);
            box-shadow: var(--shadow-sm);
            animation: fadeInUp 0.6s ease 0.4s backwards;
        }

        .search-input {
            position: relative;
        }

        .search-input i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 1.1rem;
        }

        .search-input input {
            width: 100%;
            padding: 0.875rem 1rem 0.875rem 3rem;
            border: 2px solid var(--border-color);
            border-radius: 12px;
            font-size: 0.95rem;
            font-weight: 500;
            transition: all 0.2s;
        }

        .search-input input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }

        .users-table-container {
            background: white;
            border-radius: 16px;
            border: 1px solid var(--border-color);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
            animation: fadeInUp 0.6s ease 0.5s backwards;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .users-table {
            width: 100%;
            margin: 0;
        }

        .users-table thead {
            background: linear-gradient(135deg, #f8fafc, #f1f5f9);
            border-bottom: 2px solid var(--border-color);
        }

        .users-table th {
            padding: 1.25rem 1.5rem;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #475569;
            white-space: nowrap;
        }

        .users-table tbody tr {
            border-bottom: 1px solid var(--border-color);
            transition: background-color 0.2s;
        }

        .users-table tbody tr:hover {
            background-color: #f8fafc;
        }

        .users-table tbody tr:last-child {
            border-bottom: none;
        }

        .users-table td {
            padding: 1.25rem 1.5rem;
            vertical-align: middle;
            font-size: 0.9rem;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-avatar {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1rem;
            color: white;
            flex-shrink: 0;
            text-transform: uppercase;
        }

        .user-avatar.color-1 { background: linear-gradient(135deg, #6366f1, #8b5cf6); }
        .user-avatar.color-2 { background: linear-gradient(135deg, #3b82f6, #06b6d4); }
        .user-avatar.color-3 { background: linear-gradient(135deg, #10b981, #14b8a6); }
        .user-avatar.color-4 { background: linear-gradient(135deg, #f59e0b, #f97316); }
        .user-avatar.color-5 { background: linear-gradient(135deg, #ec4899, #f43f5e); }

        .user-details h6 {
            margin: 0;
            font-weight: 700;
            color: var(--dark-color);
            font-size: 0.95rem;
        }

        .user-details p {
            margin: 0;
            color: #64748b;
            font-size: 0.85rem;
        }

        .badge {
            padding: 0.4rem 0.875rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.75rem;
            letter-spacing: 0.02em;
            display: inline-flex;
            align-items: center;
            gap: 0.375rem;
        }

        .badge i {
            font-size: 0.85rem;
        }

        .badge-success {
            background: linear-gradient(135deg, #d1fae5, #a7f3d0);
            color: #065f46;
            border: 1px solid #6ee7b7;
        }

        .badge-warning {
            background: linear-gradient(135deg, #fef3c7, #fde68a);
            color: #92400e;
            border: 1px solid #fcd34d;
        }

        .badge-primary {
            background: linear-gradient(135deg, #dbeafe, #bfdbfe);
            color: #1e40af;
            border: 1px solid #93c5fd;
        }

        .badge-danger {
            background: linear-gradient(135deg, #fecaca, #fca5a5);
            color: #991b1b;
            border: 1px solid #f87171;
        }

        .role-badge {
            padding: 0.4rem 0.875rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.75rem;
            display: inline-flex;
            align-items: center;
            gap: 0.375rem;
            background: linear-gradient(135deg, #f1f5f9, #e2e8f0);
            color: #475569;
            border: 1px solid #cbd5e1;
        }

        .role-badge i {
            font-size: 0.85rem;
        }

        .action-select {
            padding: 0.5rem 2.5rem 0.5rem 1rem;
            border: 2px solid var(--border-color);
            border-radius: 8px;
            font-size: 0.875rem;
            font-weight: 600;
            background: white;
            cursor: pointer;
            transition: all 0.2s;
            appearance: none;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23475569' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 14px;
            color: #475569;
        }

        .action-select:hover {
            border-color: var(--primary-color);
        }

        .action-select:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
@endpush

@section('content')

    <div class="page-header">
        <div class="d-flex align-items-center">
            <i class="bi bi-people text-primary me-3" style="font-size: 2.5rem;"></i>
            <div>
                <h1>Foydalanuvchilarni boshqarish</h1>
                <p>Foydalanuvchi rollari, ruxsatlari va hisob holatini boshqaring</p>
            </div>
        </div>
    </div>


    <div class="stats-cards">
        <div class="stat-card primary">
            <div class="stat-header">
                <div>
                    <div class="stat-title">Jami foydalanuvchilar</div>
                </div>
                <div class="stat-icon">
                    <i class="bi bi-people"></i>
                </div>
            </div>
            <div class="stat-value">{{ $stats['total'] ?? 5 }}</div>
        </div>

        <div class="stat-card success">
            <div class="stat-header">
                <div>
                    <div class="stat-title">Faol foydalanuvchilar</div>
                </div>
                <div class="stat-icon">
                    <i class="bi bi-check-circle"></i>
                </div>
            </div>
            <div class="stat-value">{{ $stats['active'] ?? 4 }}</div>
        </div>

        <div class="stat-card warning">
            <div class="stat-header">
                <div>
                    <div class="stat-title">Tasdiqlani kutmaqda</div>
                </div>
                <div class="stat-icon">
                    <i class="bi bi-clock-history"></i>
                </div>
            </div>
            <div class="stat-value">{{ $stats['pending'] ?? 1 }}</div>
        </div>
    </div>

    <table>
        <tbody>
        @forelse($users ?? [] as $user)
            <tr>
                <td>
                    <div class="user-info">
                        <div class="user-avatar color-{{ ($loop->index % 5) + 1 }}">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <div class="user-details">
                            <h6>{{ $user->name }}</h6>
                            <p>{{ $user->email }}</p>
                        </div>
                    </div>
                </td>
                <td>
                    @if($user->status == 'active')
                        <span class="badge badge-success">
                        <i class="bi bi-check-circle-fill"></i>
                        Active
                    </span>
                    @else
                        <span class="badge badge-warning">
                        <i class="bi bi-clock-fill"></i>
                        Pending
                    </span>
                    @endif
                </td>
                <td>
                    @if($user->roles->isNotEmpty())
                        <span class="role-badge">
                        <i class="bi bi-person-badge"></i>
                        {{ $user->roles->first()->name }}
                    </span>
                    @else
                        <span class="text-muted" style="font-style: italic; font-size: 0.85rem;">No role assigned</span>
                    @endif
                </td>
                <td>{{ $user->created_at->format('m/d/Y') }}</td>
                <td>
                    <div class="d-flex gap-2">
                        <select class="action-select">
                            <option>Admin</option>
                            <option>Menejer</option>
                            <option>Foydalanuvchi</option>
                        </select>
                        <select class="action-select">
                            <option>Faol</option>
                            <option>Nofaol</option>
                        </select>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center py-5">
                    <div class="text-muted">
                        <i class="bi bi-inbox" style="font-size: 3rem;"></i>
                        <p class="mt-3">Hozircha foydalanuvchilar yo'q</p>
                    </div>
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>


    <div class="search-box">
        <div class="search-input">
            <i class="bi bi-search"></i>
            <input type="text" class="form-control" placeholder="Foydalanuvchi nomi yoki email bo'yicha qidirish...">
        </div>
    </div>


    <div class="users-table-container">
        <div class="table-responsive">
            <table class="users-table">
                <thead>
                <tr>
                    <th>FOYDALANUVCHI</th>
                    <th>HOLAT</th>
                    <th>ROL</th>
                    <th>RO'YXATDAN O'TGAN</th>
                    <th>AMALLAR</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        <div class="user-info">
                            <div class="user-avatar color-1">A</div>
                            <div class="user-details">
                                <h6>admin</h6>
                                <p>admin@company.com</p>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span class="badge badge-success">
                            <i class="bi bi-check-circle-fill"></i>
                            Active
                        </span>
                    </td>
                    <td>
                        <span class="role-badge">
                            <i class="bi bi-shield-fill-check"></i>
                            Admin
                        </span>
                    </td>
                    <td>1/15/2024</td>
                    <td>
                        <div class="d-flex gap-2">
                            <select class="action-select">
                                <option>Admin</option>
                                <option>Menejer</option>
                                <option>Foydalanuvchi</option>
                            </select>
                            <select class="action-select">
                                <option>Faol</option>
                                <option>Nofaol</option>
                            </select>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td>
                        <div class="user-info">
                            <div class="user-avatar color-2">M</div>
                            <div class="user-details">
                                <h6>manager1</h6>
                                <p>manager@company.com</p>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span class="badge badge-success">
                            <i class="bi bi-check-circle-fill"></i>
                            Active
                        </span>
                    </td>
                    <td>
                        <span class="role-badge">
                            <i class="bi bi-person-badge"></i>
                            Manager
                        </span>
                    </td>
                    <td>1/20/2024</td>
                    <td>
                        <div class="d-flex gap-2">
                            <select class="action-select">
                                <option>Menejer</option>
                                <option>Admin</option>
                                <option>Foydalanuvchi</option>
                            </select>
                            <select class="action-select">
                                <option>Faol</option>
                                <option>Nofaol</option>
                            </select>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td>
                        <div class="user-info">
                            <div class="user-avatar color-3">J</div>
                            <div class="user-details">
                                <h6>john_doe</h6>
                                <p>john@company.com</p>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span class="badge badge-success">
                            <i class="bi bi-check-circle-fill"></i>
                            Active
                        </span>
                    </td>
                    <td>
                        <span class="role-badge">
                            <i class="bi bi-person"></i>
                            User
                        </span>
                    </td>
                    <td>2/1/2024</td>
                    <td>
                        <div class="d-flex gap-2">
                            <select class="action-select">
                                <option>Foydalanuvchi</option>
                                <option>Admin</option>
                                <option>Menejer</option>
                            </select>
                            <select class="action-select">
                                <option>Faol</option>
                                <option>Nofaol</option>
                            </select>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td>
                        <div class="user-info">
                            <div class="user-avatar color-4">J</div>
                            <div class="user-details">
                                <h6>jane_smith</h6>
                                <p>jane@company.com</p>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span class="badge badge-warning">
                            <i class="bi bi-clock-fill"></i>
                            Pending
                        </span>
                    </td>
                    <td>
                        <span class="text-muted" style="font-style: italic; font-size: 0.85rem;">No role assigned</span>
                    </td>
                    <td>2/3/2024</td>
                    <td>
                        <div class="d-flex gap-2">
                            <select class="action-select">
                                <option>Rol yo'q</option>
                                <option>Admin</option>
                                <option>Menejer</option>
                                <option>Foydalanuvchi</option>
                            </select>
                            <select class="action-select">
                                <option>Kutilmoqda</option>
                                <option>Faol</option>
                                <option>Nofaol</option>
                            </select>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td>
                        <div class="user-info">
                            <div class="user-avatar color-5">B</div>
                            <div class="user-details">
                                <h6>Mavjud emas</h6>
                                <p>bob@company.com</p>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span class="badge badge-success">
                            <i class="bi bi-check-circle-fill"></i>
                            Active
                        </span>
                    </td>
                    <td>
                        <span class="role-badge">
                            <i class="bi bi-person"></i>
                            User
                        </span>
                    </td>
                    <td>1/25/2024</td>
                    <td>
                        <div class="d-flex gap-2">
                            <select class="action-select">
                                <option>Foydalanuvchi</option>
                                <option>Admin</option>
                                <option>Menejer</option>
                            </select>
                            <select class="action-select">
                                <option>Faol</option>
                                <option>Nofaol</option>
                            </select>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

@endsection

@push('scripts')
    <script>

        document.querySelector('.search-input input').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const rows = document.querySelectorAll('.users-table tbody tr');

            rows.forEach(row => {
                const userName = row.querySelector('.user-details h6').textContent.toLowerCase();
                const userEmail = row.querySelector('.user-details p').textContent.toLowerCase();

                if (userName.includes(searchTerm) || userEmail.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>
@endpush

@extends('layouts.app')

@section('title', 'Vazifa tarixi')

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
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
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
        .stat-card:nth-child(4) { animation-delay: 0.4s; }

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

        .stat-card.gray { --accent-color: #64748b; }
        .stat-card.green { --accent-color: #10b981; }
        .stat-card.blue { --accent-color: #3b82f6; }
        .stat-card.purple { --accent-color: #8b5cf6; }

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

        .stat-card.gray .stat-icon {
            background: linear-gradient(135deg, #f1f5f9, #e2e8f0);
            color: #64748b;
        }

        .stat-card.green .stat-icon {
            background: linear-gradient(135deg, #d1fae5, #a7f3d0);
            color: #059669;
        }

        .stat-card.blue .stat-icon {
            background: linear-gradient(135deg, #dbeafe, #bfdbfe);
            color: #2563eb;
        }

        .stat-card.purple .stat-icon {
            background: linear-gradient(135deg, #ede9fe, #ddd6fe);
            color: #7c3aed;
        }

        .stat-title {
            color: #64748b;
            font-size: 0.875rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .stat-value {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--dark-color);
            line-height: 1;
            letter-spacing: -0.02em;
        }

        .search-filter-bar {
            background: white;
            border-radius: 16px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            border: 1px solid var(--border-color);
            box-shadow: var(--shadow-sm);
            animation: fadeInUp 0.6s ease 0.5s backwards;
        }

        .search-filter-container {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .search-input {
            position: relative;
            flex: 1;
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

        .filter-button {
            display: flex;
            align-items: center;
            gap: 0.625rem;
            padding: 0.875rem 1.5rem;
            border: 2px solid var(--border-color);
            border-radius: 12px;
            background: white;
            color: #475569;
            font-weight: 600;
            font-size: 0.95rem;
            cursor: pointer;
            transition: all 0.2s;
            white-space: nowrap;
        }

        .filter-button:hover {
            border-color: var(--primary-color);
            color: var(--primary-color);
            background: rgba(99, 102, 241, 0.05);
        }

        .filter-button i {
            font-size: 1.1rem;
        }

        .tasks-list-container {
            background: white;
            border-radius: 16px;
            border: 1px solid var(--border-color);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
            animation: fadeInUp 0.6s ease 0.6s backwards;
        }

        .task-item {
            padding: 1.5rem;
            border-bottom: 1px solid var(--border-color);
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 1.25rem;
        }

        .task-item:last-child {
            border-bottom: none;
        }

        .task-item:hover {
            background: #f8fafc;
        }

        .task-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #f1f5f9, #e2e8f0);
            color: #475569;
            font-size: 1.3rem;
            flex-shrink: 0;
        }

        .task-content {
            flex: 1;
            min-width: 0;
        }

        .task-title {
            margin: 0 0 0.5rem 0;
        }

        .task-title a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            font-size: 1rem;
            transition: color 0.2s;
        }

        .task-title a:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }

        .task-meta {
            display: flex;
            align-items: center;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .task-user {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .user-avatar-small {
            width: 24px;
            height: 24px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            color: white;
            font-weight: 700;
            font-size: 0.7rem;
            flex-shrink: 0;
        }

        .task-username {
            color: #64748b;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .task-date {
            display: flex;
            align-items: center;
            gap: 0.375rem;
            color: #94a3b8;
            font-size: 0.875rem;
        }

        .task-date i {
            font-size: 0.9rem;
        }

        .task-status {
            margin-left: auto;
            flex-shrink: 0;
        }

        .status-badge {
            padding: 0.4rem 0.875rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.75rem;
            letter-spacing: 0.02em;
            display: inline-block;
        }

        .status-badge.updated {
            background: linear-gradient(135deg, #dbeafe, #bfdbfe);
            color: #1e40af;
            border: 1px solid #93c5fd;
        }

        .status-badge.created {
            background: linear-gradient(135deg, #d1fae5, #a7f3d0);
            color: #065f46;
            border: 1px solid #6ee7b7;
        }

        .empty-state {
            padding: 4rem 2rem;
            text-align: center;
        }

        .empty-state i {
            font-size: 4rem;
            color: #cbd5e1;
            margin-bottom: 1rem;
        }

        .empty-state h4 {
            color: #64748b;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .empty-state p {
            color: #94a3b8;
            margin: 0;
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

        @media (max-width: 768px) {
            .search-filter-container {
                flex-direction: column;
            }

            .filter-button {
                width: 100%;
                justify-content: center;
            }

            .task-meta {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
            }

            .task-status {
                margin-left: 0;
            }
        }
    </style>
@endpush

@section('content')
    <div class="page-header">
        <div class="d-flex align-items-center">
            <i class="bi bi-clock-history text-primary me-3" style="font-size: 2.5rem;"></i>
            <div>
                <h1>Vazifa tarixi</h1>
                <p>Barcha vazifa faoliyatlarining to'liq auditlash jurnali</p>
            </div>
        </div>
</div>

    <div class="stats-cards">
        <div class="stat-card gray">
            <div class="stat-header">
                <div>
                    <div class="stat-title">Jami hodisalar</div>
                </div>
                <div class="stat-icon">
                    <i class="bi bi-graph-up"></i>
                </div>
            </div>
            <div class="stat-value">10</div>
        </div>

        <div class="stat-card green">
            <div class="stat-header">
                <div>
                    <div class="stat-title">Vazifa yaratilgan</div>
                </div>
                <div class="stat-icon">
                    <i class="bi bi-plus-circle"></i>
                </div>
            </div>
            <div class="stat-value">0</div>
        </div>

        <div class="stat-card blue">
            <div class="stat-header">
                <div>
                    <div class="stat-title">Holat o'zgarishlari</div>
                </div>
                <div class="stat-icon">
                    <i class="bi bi-arrow-right-circle"></i>
                </div>
            </div>
            <div class="stat-value">0</div>
        </div>

        <div class="stat-card purple">
            <div class="stat-header">
                <div>
                    <div class="stat-title">Tayinlanganlar</div>
                </div>
                <div class="stat-icon">
                    <i class="bi bi-people"></i>
                </div>
            </div>
            <div class="stat-value">0</div>
        </div>
    </div>

    <div class="search-filter-bar">
        <div class="search-filter-container">
            <div class="search-input">
                <i class="bi bi-search"></i>
                <input type="text" class="form-control" placeholder="Vazifa, foydalanuvchi yoki amal bo'yicha qidirish...">
            </div>
            <button class="filter-button">
                <i class="bi bi-funnel"></i>
                <span>Barcha amallar</span>
            </button>
        </div>
    </div>

    <div class="tasks-list-container">

        <div class="task-item">
            <div class="task-icon">
                <i class="bi bi-pencil-square"></i>
            </div>
            <div class="task-content">
                <h5 class="task-title">
                    <a href="#">Implement email notifications</a>
                </h5>
                <div class="task-meta">
                    <div class="task-user">
                        <div class="user-avatar-small">U</div>
                        <span class="task-username">Noma'lum</span>
                    </div>
                    <div class="task-date">
                        <i class="bi bi-calendar"></i>
                        <span>Feb 4, 2024, 02:30 PM</span>
                    </div>
                </div>
            </div>
            <div class="task-status">
                <span class="status-badge updated">updated</span>
            </div>
        </div>


        <div class="task-item">
            <div class="task-icon">
                <i class="bi bi-pencil-square"></i>
            </div>
            <div class="task-content">
                <h5 class="task-title">
                    <a href="#">Write API documentation</a>
                </h5>
                <div class="task-meta">
                    <div class="task-user">
                        <div class="user-avatar-small">U</div>
                        <span class="task-username">Noma'lum</span>
                    </div>
                    <div class="task-date">
                        <i class="bi bi-calendar"></i>
                        <span>Feb 4, 2024, 01:00 PM</span>
                    </div>
                </div>
            </div>
            <div class="task-status">
                <span class="status-badge created">created</span>
            </div>
        </div>


        <div class="task-item">
            <div class="task-icon">
                <i class="bi bi-pencil-square"></i>
            </div>
            <div class="task-content">
                <h5 class="task-title">
                    <a href="#">Write API documentation</a>
                </h5>
                <div class="task-meta">
                    <div class="task-user">
                        <div class="user-avatar-small">U</div>
                        <span class="task-username">Noma'lum</span>
                    </div>
                    <div class="task-date">
                        <i class="bi bi-calendar"></i>
                        <span>Feb 4, 2024, 01:00 PM</span>
                    </div>
                </div>
            </div>
            <div class="task-status">
                <span class="status-badge updated">updated</span>
            </div>
        </div>


        <div class="task-item">
            <div class="task-icon">
                <i class="bi bi-pencil-square"></i>
            </div>
            <div class="task-content">
                <h5 class="task-title">
                    <a href="#">Design database schema</a>
                </h5>
                <div class="task-meta">
                    <div class="task-user">
                        <div class="user-avatar-small">U</div>
                        <span class="task-username">Noma'lum</span>
                    </div>
                    <div class="task-date">
                        <i class="bi bi-calendar"></i>
                        <span>Feb 3, 2024, 07:30 PM</span>
                    </div>
                </div>
            </div>
            <div class="task-status">
                <span class="status-badge updated">updated</span>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>

        document.querySelector('.search-input input').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const taskItems = document.querySelectorAll('.task-item');

            taskItems.forEach(item => {
                const title = item.querySelector('.task-title a').textContent.toLowerCase();
                const username = item.querySelector('.task-username').textContent.toLowerCase();

                if (title.includes(searchTerm) || username.includes(searchTerm)) {
                    item.style.display = '';
                } else {
                    item.style.display = 'none';
                }
            });
        });


        document.querySelector('.filter-button').addEventListener('click', function() {
            alert('Filter funksiyasi: Bu yerda filter modal yoki dropdown ochilishi mumkin');
        });
    </script>
@endpush

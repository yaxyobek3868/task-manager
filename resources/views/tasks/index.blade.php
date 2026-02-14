@extends('layouts.app')

@section('content')
<main class="container">
    <div class="page-header">
        <div>
            <div class="page-title">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                </svg>
                <h1>Vazifalar</h1>
            </div>
            <p class="page-subtitle">Barcha vazifalarni boshqaring va kuzating</p>
        </div>
        <button class="btn-primary">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M12 4v16m8-8H4"/>
            </svg>
            Vazifa yaratish
        </button>
    </div>

    <div class="stats-grid">
        <div class="stat-card active">
            <div class="stat-label">Barcha vazifalar</div>
            <div class="stat-value">5</div>
        </div>
        <div class="stat-card pending">
            <div class="stat-label">Kutilmoqda</div>
            <div class="stat-value">2</div>
        </div>
        <div class="stat-card progress">
            <div class="stat-label">Jarayonda</div>
            <div class="stat-value">2</div>
        </div>
        <div class="stat-card completed">
            <div class="stat-label">Bajarildi</div>
            <div class="stat-value">1</div>
        </div>
    </div>

    <div class="tasks-list">
        <div class="task-card">
            <div class="task-header">
                <div>
                    <h3 class="task-title">Implement user authentication</h3>
                    <p class="task-description">Add JWT-based authentication with refresh tokens</p>
                </div>
                <span class="status-badge done">
                        <span class="status-dot"></span>
                        Done
                    </span>
            </div>
            <div class="task-meta">
                    <span class="task-meta-item">
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        John Doe
                    </span>
                <span class="task-meta-item">
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Due 2/6/2024
                    </span>
                <span class="task-meta-item">Created by Manager One</span>
            </div>
        </div>

        <div class="task-card">
            <div class="task-header">
                <div>
                    <h3 class="task-title">Design database schema</h3>
                    <p class="task-description">Create PostgreSQL schema for task management system</p>
                </div>
                <span class="status-badge progress">
                        <span class="status-dot"></span>
                        In progress
                    </span>
            </div>
            <div class="task-meta">
                    <span class="task-meta-item">
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        John Doe
                    </span>
                <span class="task-meta-item">
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Due 2/11/2024
                    </span>
                <span class="task-meta-item">Created by Admin</span>
            </div>
        </div>

        <div class="task-card">
            <div class="task-header">
                <div>
                    <h3 class="task-title">Setup CI/CD pipeline</h3>
                    <p class="task-description">Configure GitHub Actions for automated testing and deployment</p>
                </div>
                <span class="status-badge pending">
                        <span class="status-dot"></span>
                        Pending
                    </span>
            </div>
            <div class="task-meta">
                    <span class="task-meta-item">
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        Bob Wilson
                    </span>
                <span class="task-meta-item">
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Due 2/16/2024
                    </span>
                <span class="task-meta-item">Created by Admin</span>
            </div>
        </div>

        <div class="task-card">
            <div class="task-header">
                <div>
                    <h3 class="task-title">Write API documentation</h3>
                    <p class="task-description">Document all REST API endpoints using OpenAPI specification</p>
                </div>
                <span class="status-badge pending">
                        <span class="status-dot"></span>
                        Pending
                    </span>
            </div>
            <div class="task-meta">
                    <span class="task-meta-item">
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        Manager One
                    </span>
                <span class="task-meta-item">
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Due 2/13/2024
                    </span>
                <span class="task-meta-item">Created by Manager One</span>
            </div>
        </div>
    </div>
</main>
@endsection

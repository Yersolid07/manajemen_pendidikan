import { Head, Link, router, usePage } from '@inertiajs/react';
import { useState } from 'react';

export default function AppLayout({ children, title }) {
    const { auth } = usePage().props;
    const [sidebarOpen, setSidebarOpen] = useState(false);

    const handleLogout = (e) => {
        e.preventDefault();
        router.post('/logout');
    };

    const userInitials = auth.user?.name
        ? auth.user.name.split(' ').map(n => n[0]).join('').toUpperCase().slice(0, 2)
        : '?';

    const getRoleBadgeClass = () => {
        switch (auth.user?.role) {
            case 'admin': return 'badge-role role-admin';
            case 'operator_dikda': return 'badge-role role-dikda';
            case 'operator_sekolah': return 'badge-role role-sekolah';
            default: return 'badge-role';
        }
    };

    return (
        <>
            <Head title={title} />

            {/* Sidebar */}
            <aside className={`app-sidebar ${sidebarOpen ? 'show' : ''}`}>
                <div className="sidebar-header">
                    <Link href="/dashboard" className="brand">
                        <div className="brand-icon">📊</div>
                        <div className="brand-text">
                            SPMB Sulut
                            <small>Monitoring Kebutuhan Guru</small>
                        </div>
                    </Link>
                </div>

                <nav className="sidebar-nav">
                    <div className="nav-section">Menu Utama</div>
                    <div className="nav-item">
                        <Link
                            href="/dashboard"
                            className={`nav-link ${window.location.pathname === '/dashboard' ? 'active' : ''}`}
                        >
                            <span className="nav-icon">📋</span>
                            Dashboard
                        </Link>
                    </div>

                    {(auth.user?.role === 'admin' || auth.user?.role === 'operator_dikda') && (
                        <>
                            <div className="nav-section">Data Master</div>
                            <div className="nav-item">
                                <span className="nav-link" style={{ opacity: 0.5, cursor: 'not-allowed' }}>
                                    <span className="nav-icon">🏫</span>
                                    Sekolah
                                    <span className="badge bg-secondary ms-auto" style={{ fontSize: '0.6rem' }}>Segera</span>
                                </span>
                            </div>
                            <div className="nav-item">
                                <span className="nav-link" style={{ opacity: 0.5, cursor: 'not-allowed' }}>
                                    <span className="nav-icon">📚</span>
                                    Mata Pelajaran
                                    <span className="badge bg-secondary ms-auto" style={{ fontSize: '0.6rem' }}>Segera</span>
                                </span>
                            </div>
                        </>
                    )}

                    {auth.user?.role === 'admin' && (
                        <>
                            <div className="nav-section">Administrasi</div>
                            <div className="nav-item">
                                <span className="nav-link" style={{ opacity: 0.5, cursor: 'not-allowed' }}>
                                    <span className="nav-icon">👥</span>
                                    Manajemen User
                                    <span className="badge bg-secondary ms-auto" style={{ fontSize: '0.6rem' }}>Segera</span>
                                </span>
                            </div>
                        </>
                    )}
                </nav>

                <div className="sidebar-footer">
                    <div className="user-info">
                        <div className="user-avatar">{userInitials}</div>
                        <div className="user-details">
                            <div className="user-name">{auth.user?.name}</div>
                            <div className="user-role">{auth.user?.role_display}</div>
                        </div>
                    </div>
                </div>
            </aside>

            {/* Topbar */}
            <header className="app-topbar">
                <div className="d-flex align-items-center gap-3">
                    <button
                        className="btn btn-link text-light d-lg-none p-0"
                        onClick={() => setSidebarOpen(!sidebarOpen)}
                        style={{ fontSize: '1.5rem', textDecoration: 'none' }}
                    >
                        ☰
                    </button>
                    <h1 className="page-title mb-0">{title || 'Dashboard'}</h1>
                </div>

                <div className="d-flex align-items-center gap-3">
                    <span className={getRoleBadgeClass()}>
                        {auth.user?.role_display}
                    </span>
                    <button
                        onClick={handleLogout}
                        className="btn btn-outline-light btn-sm"
                        style={{
                            borderColor: 'rgba(148, 163, 184, 0.2)',
                            color: 'var(--text-secondary)',
                            fontSize: '0.85rem',
                        }}
                    >
                        Keluar
                    </button>
                </div>
            </header>

            {/* Mobile overlay */}
            {sidebarOpen && (
                <div
                    className="d-lg-none"
                    style={{
                        position: 'fixed',
                        inset: 0,
                        background: 'rgba(0,0,0,0.5)',
                        zIndex: 999,
                    }}
                    onClick={() => setSidebarOpen(false)}
                />
            )}

            {/* Main Content */}
            <main className="app-content">
                {children}
            </main>
        </>
    );
}

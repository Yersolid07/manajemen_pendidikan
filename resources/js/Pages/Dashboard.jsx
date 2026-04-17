import AppLayout from '@/Layouts/AppLayout';
import { usePage } from '@inertiajs/react';

export default function Dashboard({ stats }) {
    const { auth } = usePage().props;

    const getGreeting = () => {
        const hour = new Date().getHours();
        if (hour < 12) return 'Selamat Pagi';
        if (hour < 15) return 'Selamat Siang';
        if (hour < 18) return 'Selamat Sore';
        return 'Selamat Malam';
    };

    const statCards = [
        {
            label: 'Total SMA',
            value: stats.total_sma ?? 0,
            icon: '🏫',
            visible: true,
        },
        {
            label: 'Total SMK',
            value: stats.total_smk ?? 0,
            icon: '🏭',
            visible: true,
        },
        {
            label: 'Mata Pelajaran',
            value: stats.total_mata_pelajaran ?? 0,
            icon: '📚',
            visible: true,
        },
        {
            label: 'Total Sekolah (SMA/SMK)',
            value: stats.total_organizations ?? 0,
            icon: '📊',
            visible: auth.user?.role === 'admin' || auth.user?.role === 'operator_dikda',
        },
        {
            label: 'Pengguna Terdaftar',
            value: stats.total_users ?? 0,
            icon: '👥',
            visible: auth.user?.role === 'admin',
        },
    ].filter(card => card.visible);

    return (
        <AppLayout title="Dashboard">
            {/* Welcome Section */}
            <div className="mb-4 animate-fade-in-up">
                <h2 className="fw-bold mb-1" style={{ color: 'var(--text-primary)' }}>
                    {getGreeting()}, {auth.user?.name}! 👋
                </h2>
                <p className="mb-0" style={{ color: 'var(--text-secondary)' }}>
                    Selamat datang di Sistem Pemantauan & Manajemen Kebutuhan Guru Sulawesi Utara.
                </p>
            </div>

            {/* Stat Cards Grid */}
            <div className="row g-4 mb-4">
                {statCards.map((card, index) => (
                    <div
                        key={card.label}
                        className={`col-12 col-sm-6 col-xl-${statCards.length <= 4 ? '3' : '4'} animate-fade-in-up animate-delay-${index + 1}`}
                    >
                        <div className="stat-card">
                            <div className="d-flex align-items-start justify-content-between mb-3">
                                <div className="stat-icon">{card.icon}</div>
                            </div>
                            <div className="stat-value">{card.value.toLocaleString('id-ID')}</div>
                            <div className="stat-label mt-1">{card.label}</div>
                        </div>
                    </div>
                ))}
            </div>

            {/* Info Card */}
            <div className="row">
                <div className="col-12 animate-fade-in-up animate-delay-5">
                    <div className="glass-card p-4">
                        <h5 className="fw-bold mb-3" style={{ color: 'var(--text-primary)' }}>
                            ℹ️ Informasi Sistem
                        </h5>
                        <div className="row g-3">
                            <div className="col-md-6">
                                <div className="p-3" style={{
                                    background: 'rgba(6, 182, 212, 0.05)',
                                    borderRadius: '0.75rem',
                                    border: '1px solid rgba(6, 182, 212, 0.1)',
                                }}>
                                    <h6 className="fw-semibold mb-2" style={{ color: 'var(--text-accent)' }}>
                                        📌 Tahap Pengembangan
                                    </h6>
                                    <p className="mb-0" style={{ color: 'var(--text-secondary)', fontSize: '0.85rem' }}>
                                        Sistem ini sedang dalam tahap pengembangan. Fitur-fitur seperti manajemen
                                        data sekolah, perhitungan kebutuhan guru, dan pelaporan akan ditambahkan
                                        secara bertahap.
                                    </p>
                                </div>
                            </div>
                            <div className="col-md-6">
                                <div className="p-3" style={{
                                    background: 'rgba(16, 185, 129, 0.05)',
                                    borderRadius: '0.75rem',
                                    border: '1px solid rgba(16, 185, 129, 0.1)',
                                }}>
                                    <h6 className="fw-semibold mb-2" style={{ color: '#34d399' }}>
                                        ✅ Fitur Aktif
                                    </h6>
                                    <ul className="mb-0 ps-3" style={{ color: 'var(--text-secondary)', fontSize: '0.85rem' }}>
                                        <li>Autentikasi & otorisasi berbasis role</li>
                                        <li>Dashboard ringkasan data</li>
                                        <li>Data organisasi/sekolah Dapodik</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </AppLayout>
    );
}

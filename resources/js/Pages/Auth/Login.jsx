import { useForm } from '@inertiajs/react';
import GuestLayout from '@/Layouts/GuestLayout';
import { useState } from 'react';

export default function Login() {
    const { data, setData, post, processing, errors, reset } = useForm({
        email: '',
        password: '',
        remember: false,
    });

    const [showPassword, setShowPassword] = useState(false);

    const handleSubmit = (e) => {
        e.preventDefault();
        post('/login', {
            onFinish: () => reset('password'),
        });
    };

    return (
        <GuestLayout title="Masuk">
            <div className="login-card">
                {/* Logo */}
                <div className="login-logo">📊</div>

                {/* Title */}
                <div className="text-center mb-4">
                    <h1 className="fw-bold mb-1 fs-4" style={{ color: 'var(--text-primary)' }}>
                        SPMB Sulut
                    </h1>
                    <p className="mb-0" style={{ color: 'var(--text-secondary)', fontSize: '0.85rem' }}>
                        Sistem Pemantauan & Manajemen Kebutuhan Guru
                    </p>
                    <p className="mb-0" style={{ color: 'var(--text-secondary)', fontSize: '0.75rem', opacity: 0.7 }}>
                        Dinas Pendidikan Daerah Prov. Sulawesi Utara
                    </p>
                </div>

                {/* Error Alert */}
                {errors.email && (
                    <div className="alert-glass mb-3 animate-fade-in">
                        <span>⚠️</span> {errors.email}
                    </div>
                )}

                {/* Form */}
                <form onSubmit={handleSubmit}>
                    <div className="form-floating mb-3">
                        <input
                            type="email"
                            id="login-email"
                            className={`form-control ${errors.email ? 'is-invalid' : ''}`}
                            placeholder="nama@email.com"
                            value={data.email}
                            onChange={(e) => setData('email', e.target.value)}
                            autoComplete="email"
                            autoFocus
                        />
                        <label htmlFor="login-email">Alamat Email</label>
                    </div>

                    <div className="form-floating mb-3 position-relative">
                        <input
                            type={showPassword ? 'text' : 'password'}
                            id="login-password"
                            className={`form-control ${errors.password ? 'is-invalid' : ''}`}
                            placeholder="Password"
                            value={data.password}
                            onChange={(e) => setData('password', e.target.value)}
                            autoComplete="current-password"
                        />
                        <label htmlFor="login-password">Password</label>
                        <button
                            type="button"
                            className="btn btn-link position-absolute"
                            style={{
                                right: '10px',
                                top: '50%',
                                transform: 'translateY(-50%)',
                                color: 'var(--text-secondary)',
                                textDecoration: 'none',
                                fontSize: '1.1rem',
                                zIndex: 5,
                            }}
                            onClick={() => setShowPassword(!showPassword)}
                            tabIndex={-1}
                        >
                            {showPassword ? (
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round"><path d="M9.88 9.88a3 3 0 1 0 4.24 4.24"/><path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"/><path d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61"/><line x1="2" x2="22" y1="2" y2="22"/></svg>
                            ) : (
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                            )}
                        </button>
                        {errors.password && (
                            <div className="invalid-feedback">{errors.password}</div>
                        )}
                    </div>

                    <div className="d-flex align-items-center justify-content-between mb-4">
                        <div className="form-check">
                            <input
                                type="checkbox"
                                id="login-remember"
                                className="form-check-input"
                                checked={data.remember}
                                onChange={(e) => setData('remember', e.target.checked)}
                            />
                            <label
                                className="form-check-label"
                                htmlFor="login-remember"
                                style={{ color: 'var(--text-secondary)', fontSize: '0.85rem' }}
                            >
                                Ingat saya
                            </label>
                        </div>
                    </div>

                    <button
                        type="submit"
                        className="btn btn-login w-100"
                        disabled={processing}
                    >
                        {processing ? (
                            <span className="d-flex align-items-center justify-content-center gap-2">
                                <span className="spinner-border spinner-border-sm" role="status" />
                                Memproses...
                            </span>
                        ) : (
                            'Masuk'
                        )}
                    </button>
                </form>

                {/* Footer */}
                <div className="text-center mt-4">
                    <small style={{ color: 'var(--text-secondary)', fontSize: '0.75rem', opacity: 0.6 }}>
                        © 2026 Dinas Pendidikan Daerah Prov. Sulawesi Utara
                    </small>
                </div>
            </div>
        </GuestLayout>
    );
}


<style>
    /* Reset & Container Utama */
    .referral-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 70vh;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        padding: 20px;
    }

    /* Kotak Kartu */
    .referral-card {
        background: #ffffff;
        width: 100%;
        max-width: 450px;
        border-radius: 12px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        border: 1px solid #eef2f5;
    }

    /* Kepala Kartu */
    .referral-header {
        background: linear-gradient(135deg, #2563eb, #1d4ed8);
        color: #ffffff;
        padding: 24px;
        text-align: center;
    }

    .referral-header h5 {
        margin: 0;
        font-size: 1.25rem;
        font-weight: 600;
        letter-spacing: 0.5px;
    }

    /* Isi Kartu */
    .referral-body {
        padding: 28px;
    }

    .referral-desc {
        color: #64748b;
        font-size: 0.9rem;
        line-height: 1.5;
        margin-bottom: 24px;
        text-align: center;
    }

    /* Kotak Pesan / Notifikasi */
    .alert-box {
        padding: 12px 16px;
        border-radius: 8px;
        font-size: 0.9rem;
        margin-bottom: 20px;
        font-weight: 500;
    }
    
    .alert-box.success {
        background-color: #f0fdf4;
        color: #166534;
        border: 1px solid #bbf7d0;
    }

    .alert-box.error {
        background-color: #fef2f2;
        color: #991b1b;
        border: 1px solid #fecaca;
    }

    /* Form Input */
    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        display: block;
        font-size: 0.85rem;
        font-weight: 600;
        color: #334155;
        margin-bottom: 8px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .form-input {
        width: 100%;
        padding: 12px 14px;
        border: 1.5px solid #cbd5e1;
        border-radius: 8px;
        font-size: 0.95rem;
        color: #1e293b;
        transition: all 0.2s ease;
        box-sizing: border-box;
    }

    .form-input:focus {
        outline: none;
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
    }

    .form-input.is-invalid {
        border-color: #ef4444;
    }

    .error-text {
        color: #ef4444;
        font-size: 0.8rem;
        margin-top: 6px;
        display: block;
    }

    /* Tombol Submit */
    .btn-submit {
        width: 100%;
        padding: 14px;
        background: #2563eb;
        color: #ffffff;
        border: none;
        border-radius: 8px;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.2s ease;
    }

    .btn-submit:hover {
        background: #1d4ed8;
    }
</style>

<div class="referral-wrapper">
    <div class="referral-card">
        <div class="referral-header">
            <h5>Klaim Kode Referral Teman</h5>
        </div>
        <div class="referral-body">
            
            {{-- Notifikasi Sukses --}}
            @if(session('success'))
                <div class="alert-box success">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Notifikasi Gagal/Eror --}}
            @if(session('error'))
                <div class="alert-box error">
                    {{ session('error') }}
                </div>
            @endif

            <p class="referral-desc">Masukkan kode referral yang kamu dapatkan dari temanmu untuk mendapatkan bonus saldo poin loyalty awal.</p>

            {{-- Form Aksi --}}
            <form action="{{ route('referral.claim') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="referrer_code" class="form-label">Kode Referral</label>
                    <input type="text" name="referrer_code" id="referrer_code" 
                           class="form-input @error('referrer_code') is-invalid @enderror" 
                           placeholder="Contoh: REF-12345" required>
                    
                    @error('referrer_code')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn-submit">Klaim Poin Bonus</button>
            </form>

        </div>
    </div>
</div>

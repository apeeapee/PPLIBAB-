<style>
    /* ====== CONSISTENT SELLER PAGE STYLES ====== */
    .content-wrapper {
        padding-top: 30px;
    }

    /* PAGE HEADER */
    .page-header {
        margin-bottom: 32px;
        margin-top: 10px;
    }
    .page-title {
        font-size: 28px;
        font-weight: 700;
        color: var(--text-main);
        margin-bottom: 6px;
        line-height: 1.2;
    }
    .page-subtitle {
        font-size: 14px;
        color: var(--text-muted);
        line-height: 1.4;
    }

    /* HEADER WITH ACTION BUTTON */
    .page-header-with-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 32px;
        margin-top: 10px;
        flex-wrap: wrap;
        gap: 16px;
    }
    .page-header-with-actions .page-title {
        margin: 0;
    }
    .page-header-with-actions .page-subtitle {
        margin: 4px 0 0 0;
    }

    /* BUTTONS */
    .btn-primary {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 16px;
        background: var(--accent);
        color: #111827;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s;
    }
    .btn-primary:hover {
        background: var(--accent-hover);
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(249,115,22,0.3);
    }
    .btn-sm {
        padding: 6px 12px;
        font-size: 12px;
    }

    /* ALERTS */
    .alert {
        padding: 16px 20px;
        border-radius: 12px;
        margin-bottom: 24px;
        display: flex;
        align-items: flex-start;
        gap: 12px;
    }
    .alert-warning {
        background: rgba(234,179,8,0.1);
        border: 1px solid rgba(234,179,8,0.3);
    }
    .alert-error {
        background: rgba(239,68,68,0.1);
        border: 1px solid rgba(239,68,68,0.3);
    }
    .alert-success {
        background: rgba(34,197,94,0.1);
        border: 1px solid rgba(34,197,94,0.3);
    }
    .alert i {
        font-size: 20px;
    }
    .alert-content {
        flex: 1;
    }
    .alert-title {
        font-weight: 600;
        color: var(--text-main);
        margin-bottom: 4px;
    }
    .alert-text {
        font-size: 13px;
        color: var(--text-muted);
    }

    /* CARDS */
    .card {
        background: var(--card-bg);
        border: 1px solid var(--card-border);
        border-radius: 16px;
        padding: 24px;
        margin-bottom: 24px;
    }
    .card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
    }
    .card-title {
        font-size: 18px;
        font-weight: 700;
        color: var(--text-main);
    }
    .card-subtitle {
        font-size: 14px;
        color: var(--text-muted);
        margin-top: 4px;
    }

    /* EMPTY STATE */
    .empty-state {
        text-align: center;
        padding: 48px 24px;
    }
    .empty-state i {
        font-size: 64px;
        color: var(--text-muted);
        margin-bottom: 16px;
    }
    .empty-state p {
        color: var(--text-muted);
        margin-bottom: 20px;
    }

    /* RESPONSIVE */
    @media (max-width: 768px) {
        .page-title {
            font-size: 24px;
        }
        .page-header-with-actions {
            flex-direction: column;
            align-items: flex-start;
        }
        .btn-primary {
            width: 100%;
            justify-content: center;
        }
    }
</style>
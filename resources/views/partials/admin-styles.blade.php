<style>
    /* ====== CONSISTENT ADMIN PAGE STYLES ====== */
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
    .btn-action {
        padding: 6px 12px;
        background: rgba(59,130,246,0.1);
        color: #3b82f6;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.2s;
    }
    .btn-action:hover {
        background: rgba(59,130,246,0.2);
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
        color: #eab308;
    }
    .alert-error {
        background: rgba(239,68,68,0.1);
        border: 1px solid rgba(239,68,68,0.3);
        color: #ef4444;
    }
    .alert-success {
        background: rgba(34,197,94,0.1);
        border: 1px solid rgba(34,197,94,0.3);
        color: #22c55e;
    }
    .alert-info {
        background: rgba(59,130,246,0.1);
        border: 1px solid rgba(59,130,246,0.3);
        color: #3b82f6;
    }
    .alert i {
        font-size: 20px;
    }
    .alert-content {
        flex: 1;
    }
    .alert-title {
        font-weight: 600;
        margin-bottom: 4px;
    }
    .alert-text {
        font-size: 13px;
        line-height: 1.4;
    }

    /* TABLES */
    .table-container {
        background: var(--card-bg);
        border: 1px solid var(--card-border);
        border-radius: 16px;
        overflow: hidden;
        margin-bottom: 24px;
    }
    .table-header {
        padding: 20px 24px;
        border-bottom: 1px solid var(--card-border);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .table-title {
        font-size: 18px;
        font-weight: 700;
        color: var(--text-main);
    }
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th {
        text-align: left;
        padding: 12px 24px;
        font-size: 12px;
        font-weight: 600;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 1px solid var(--card-border);
        background: rgba(249,115,22,0.05);
    }
    td {
        padding: 16px 24px;
        border-bottom: 1px solid var(--card-border);
        font-size: 14px;
        color: var(--text-main);
    }
    tr:hover td {
        background: rgba(249,115,22,0.03);
    }

    /* BADGES */
    .badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 4px 12px;
        border-radius: 50px;
        font-size: 12px;
        font-weight: 600;
    }
    .badge-approved {
        background: rgba(34,197,94,0.1);
        color: #22c55e;
    }
    .badge-pending {
        background: rgba(234,179,8,0.1);
        color: #eab308;
    }
    .badge-rejected {
        background: rgba(239,68,68,0.1);
        color: #ef4444;
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
        .table-container {
            overflow-x: auto;
        }
        table {
            min-width: 600px;
        }
    }
</style>
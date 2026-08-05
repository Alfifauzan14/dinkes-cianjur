<style>
    .form-page-container {
        max-width: 820px;
        margin: 0 auto;
    }
    .form-section-card {
        background: #ffffff;
        border-radius: 10px;
        box-shadow: var(--card-shadow);
        margin-bottom: 20px;
        overflow: hidden;
    }
    .form-section-header {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 16px 24px;
        border-bottom: 1px solid var(--border-subtle);
        background: #FAFBFC;
    }
    .form-section-header .section-icon {
        width: 34px;
        height: 34px;
        border-radius: 8px;
        background: var(--sidebar-accent-dim);
        color: var(--brand-green);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .form-section-header h3 {
        font-size: 14px;
        font-weight: 700;
        color: var(--text-primary);
        margin: 0;
    }
    .form-section-header p {
        font-size: 12px;
        color: var(--text-secondary);
        margin: 0;
    }
    .form-section-body { padding: 24px; }
    .icon-picker-wrapper {
        display: flex;
        align-items: flex-start;
        gap: 12px;
    }
    .icon-preview-box {
        width: 48px;
        height: 48px;
        border-radius: 8px;
        background: var(--sidebar-accent-dim);
        color: var(--brand-green);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        font-size: 24px;
        border: 2px solid rgba(0,153,102,0.2);
        transition: all 0.18s;
    }
    .intervensi-item {
        background: #F8FAFC;
        border: 1px solid var(--border-subtle);
        border-radius: 8px;
        padding: 18px 20px;
        margin-bottom: 12px;
        position: relative;
        transition: border-color 0.18s;
    }
    .intervensi-item:focus-within {
        border-color: #009966;
        background: #FFFFFE;
    }
    .intervensi-item .remove-btn {
        position: absolute;
        top: 12px;
        right: 12px;
        width: 28px;
        height: 28px;
        border-radius: 6px;
        border: none;
        background: #FEE2E2;
        color: #DC2626;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.15s;
    }
    .intervensi-item .remove-btn:hover { background: #FCA5A5; }
    .intervensi-icon-preview {
        width: 32px;
        height: 32px;
        border-radius: 6px;
        background: var(--sidebar-accent-dim);
        color: var(--brand-green);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        flex-shrink: 0;
        border: 1px solid rgba(0,153,102,0.2);
        vertical-align: middle;
    }
    .stat-card-mini {
        background: #F8FAFC;
        border: 1px solid var(--border-subtle);
        border-radius: 8px;
        padding: 16px;
        text-align: center;
    }
    .stat-card-mini .stat-num-preview {
        font-size: 22px;
        font-weight: 800;
        color: var(--brand-green);
        display: block;
        line-height: 1;
        margin-bottom: 4px;
    }
    .stat-card-mini .stat-label-preview {
        font-size: 11px;
        color: var(--text-secondary);
        font-weight: 600;
    }
    .status-toggle {
        display: flex;
        gap: 0;
        border: 1px solid var(--border-subtle);
        border-radius: 8px;
        overflow: hidden;
    }
    .status-toggle label {
        flex: 1;
        margin: 0 !important;
        cursor: pointer;
    }
    .status-toggle input[type="radio"] { display: none; }
    .status-toggle label .status-option {
        padding: 10px 16px;
        text-align: center;
        font-size: 13px;
        font-weight: 600;
        color: var(--text-secondary);
        transition: all 0.18s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
    }
    .status-toggle input[type="radio"]:checked + .status-option {
        background: var(--brand-green);
        color: #fff;
    }
    .content-textarea {
        font-family: 'Roboto Mono', 'Courier New', monospace !important;
        font-size: 13px !important;
        line-height: 1.6 !important;
        min-height: 200px;
        background: #1E293B !important;
        color: #E2E8F0 !important;
        border-color: #334155 !important;
        border-radius: 8px !important;
        padding: 16px !important;
        resize: vertical;
    }
    .content-textarea:focus {
        border-color: #009966 !important;
        box-shadow: var(--input-focus-ring) !important;
    }
    .html-hint { display: flex; flex-wrap: wrap; gap: 6px; margin-top: 10px; }
    .html-tag-chip {
        background: #1E293B;
        color: #94A3B8;
        padding: 3px 10px;
        border-radius: 4px;
        font-size: 11.5px;
        font-family: monospace;
        cursor: pointer;
        border: 1px solid #334155;
        transition: all 0.15s;
    }
    .html-tag-chip:hover { background: #334155; color: #E2E8F0; }
    .char-counter {
        font-size: 11.5px;
        color: var(--text-secondary);
        text-align: right;
        margin-top: 4px;
    }
    .page-actions-bar {
        background: #ffffff;
        border-radius: 10px;
        box-shadow: var(--card-shadow);
        padding: 16px 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
    }
</style>

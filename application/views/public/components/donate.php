<?php
$CI =& get_instance();

$donate =
$CI->db
->limit(1)
->get('donate')
->row();

if(
    empty($donate) ||
    !$donate->is_active
){
    return;
}
?>

<!-- ======================================
DONATE FLOATING + MODAL
====================================== -->

<!-- FLOATING BUTTON -->
<button class="donate-float"
        data-bs-toggle="modal"
        data-bs-target="#donateModal">

    <span class="coffee-icon">
        ☕
    </span>

    <span class="donate-text">
        Traktir Kopi
    </span>

</button>

<!-- DONATE MODAL -->
<div class="modal fade"
     id="donateModal"
     tabindex="-1"
     aria-hidden="true">

    <div class="modal-dialog
                modal-dialog-centered">

        <div class="modal-content
                    donate-modal">

            <!-- CLOSE -->
            <button type="button"
                    class="btn-close donate-close"
                    data-bs-dismiss="modal"
                    aria-label="Close">
            </button>

            <div class="modal-body
                        text-center
                        p-4
                        p-md-5">

                <!-- ICON -->
                <div class="donate-icon">
                    ☕
                </div>

                <!-- TITLE -->
                <h2 class="fw-bold mb-2">

                    <?= !empty(
                        $donate->title
                    )
                    ? html_escape(
                        $donate->title
                    )
                    : 'Dukung Kami' ?>

                </h2>

                <!-- DESCRIPTION -->
                <p class="text-muted
                          donate-description
                          mb-4">

                    <?= nl2br(
                        html_escape(
                            $donate
                            ->description
                        )
                    ) ?>

                </p>

                <!-- QRIS -->
                <?php if(
                    !empty(
                        $donate
                        ->qris_image
                    )
                ): ?>

                <div class="mb-4">

                    <div class="qris-card">

                        <img src="<?= base_url(
                            'uploads/donate/' .
                            $donate
                            ->qris_image
                        ) ?>"
                        alt="QRIS Donate"
                        class="img-fluid
                               donate-qris">

                        <?php if(
                            !empty(
                                $donate
                                ->bank_name
                            )
                        ): ?>

                        <small class="text-muted
                                      d-block
                                      mt-2">

                            Scan QRIS
                            <?= html_escape(
                                $donate
                                ->bank_name
                            ) ?>

                        </small>

                        <?php endif; ?>

                    </div>

                </div>

                <?php endif; ?>

                <!-- ACTION -->
                <div class="d-grid gap-2">

                    <!-- SAWERIA -->
                    <?php if(
                        !empty(
                            $donate
                            ->saweria_url
                        )
                    ): ?>

                    <a href="<?= html_escape(
                        $donate
                        ->saweria_url
                    ) ?>"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="btn btn-success
                           btn-lg
                           rounded-pill
                           donate-btn">

                        ☕ Traktir via Saweria

                    </a>

                    <?php endif; ?>

                    <!-- BANK INFO -->
                    <?php if(
                        !empty(
                            $donate
                            ->account_number
                        )
                    ): ?>

                    <div class="bank-card">

                        <div class="small
                                    text-muted
                                    mb-1">

                            Transfer Bank

                        </div>

                        <div class="fw-bold">

                            <?= html_escape(
                                $donate
                                ->bank_name
                            ) ?>

                        </div>

                        <div class="mb-1">

                            a.n
                            <?= html_escape(
                                $donate
                                ->account_name
                            ) ?>

                        </div>

                        <div class="bank-number"
                             id="rekeningDonate">

                            <?= html_escape(
                                $donate
                                ->account_number
                            ) ?>

                        </div>

                        <button type="button"
                                class="btn
                                       btn-light
                                       border
                                       btn-sm
                                       rounded-pill
                                       mt-2"
                                onclick="copyRekening()">

                            📋 Salin Rekening

                        </button>

                    </div>

                    <?php endif; ?>

                    <!-- CLOSE -->
                    <button type="button"
                            class="btn btn-link
                                   text-secondary
                                   text-decoration-none"
                            data-bs-dismiss="modal">

                        Nanti saja

                    </button>

                </div>

                <small class="text-muted
                              d-block
                              mt-4">

                    Terima kasih sudah
                    mendukung
                    <?= html_escape(
                        $setting
                        ->site_name
                    ) ?>
                    ❤️

                </small>

            </div>

        </div>

    </div>

</div>

<style>
.donate-float{
    position:fixed;
    right:18px;
    bottom:18px;
    z-index:9999;
    border:none;
    display:flex;
    align-items:center;
    gap:10px;
    padding:12px 18px;
    border-radius:999px;
    background:
    linear-gradient(
    135deg,
    #16a34a,
    #22c55e
    );
    color:#fff;
    box-shadow:
    0 10px 30px
    rgba(34,197,94,.25);
    transition:.25s;
}

.donate-float:hover{
    transform:
    translateY(-3px);
}

.coffee-icon{
    width:38px;
    height:38px;
    border-radius:50%;
    background:
    rgba(255,255,255,.18);
    display:flex;
    align-items:center;
    justify-content:center;
}

.donate-modal{
    border:none;
    border-radius:28px;
}

.donate-close{
    position:absolute;
    top:18px;
    right:18px;
}

.donate-icon{
    width:90px;
    height:90px;
    margin:auto auto 20px;
    border-radius:50%;
    background:#ecfdf5;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:42px;
}

.qris-card{
    background:#f8fafc;
    border:1px solid #e5e7eb;
    border-radius:20px;
    padding:18px;
}

.donate-qris{
    max-width:220px;
    border-radius:18px;
}

.bank-card{
    background:#f8fafc;
    border-radius:18px;
    padding:18px;
    border:1px solid #e5e7eb;
    margin-top:10px;
}

.bank-number{
    font-size:18px;
    font-weight:700;
}

@media(max-width:768px){

    .donate-float{
        right:15px;
        bottom:15px;
        padding:10px 14px;
    }

    .donate-text{
        font-size:13px;
    }

    .modal-dialog{
        margin:15px;
    }

    .donate-modal{
        border-radius:24px;
    }

    .donate-qris{
        max-width:180px;
    }
}

<?php
$CI =& get_instance();

$donate =
$CI->db
->limit(1)
->get('donate')
->row();

if(
    empty($donate) ||
    !$donate->is_active
){
    return;
}
?>

<!-- ======================================
DONATE FLOATING + MODAL
====================================== -->

<!-- FLOATING BUTTON -->
<button class="donate-float"
        data-bs-toggle="modal"
        data-bs-target="#donateModal">

    <span class="coffee-icon">
        ☕
    </span>

    <span class="donate-text">
        Traktir Kopi
    </span>

</button>

<!-- DONATE MODAL -->
<div class="modal fade"
     id="donateModal"
     tabindex="-1"
     aria-hidden="true">

    <div class="modal-dialog
                modal-dialog-centered">

        <div class="modal-content
                    donate-modal">

            <!-- CLOSE -->
            <button type="button"
                    class="btn-close donate-close"
                    data-bs-dismiss="modal"
                    aria-label="Close">
            </button>

            <div class="modal-body
                        text-center
                        p-4
                        p-md-5">

                <!-- ICON -->
                <div class="donate-icon">
                    ☕
                </div>

                <!-- TITLE -->
                <h2 class="fw-bold mb-2">

                    <?= !empty(
                        $donate->title
                    )
                    ? html_escape(
                        $donate->title
                    )
                    : 'Dukung Kami' ?>

                </h2>

                <!-- DESCRIPTION -->
                <p class="text-muted
                          donate-description
                          mb-4">

                    <?= nl2br(
                        html_escape(
                            $donate
                            ->description
                        )
                    ) ?>

                </p>

                <!-- QRIS -->
                <?php if(
                    !empty(
                        $donate
                        ->qris_image
                    )
                ): ?>

                <div class="mb-4">

                    <div class="qris-card">

                        <img src="<?= base_url(
                            'uploads/donate/' .
                            $donate
                            ->qris_image
                        ) ?>"
                        alt="QRIS Donate"
                        class="img-fluid
                               donate-qris">

                        <?php if(
                            !empty(
                                $donate
                                ->bank_name
                            )
                        ): ?>

                        <small class="text-muted
                                      d-block
                                      mt-2">

                            Scan QRIS
                            <?= html_escape(
                                $donate
                                ->bank_name
                            ) ?>

                        </small>

                        <?php endif; ?>

                    </div>

                </div>

                <?php endif; ?>

                <!-- ACTION -->
                <div class="d-grid gap-2">

                    <!-- SAWERIA -->
                    <?php if(
                        !empty(
                            $donate
                            ->saweria_url
                        )
                    ): ?>

                    <a href="<?= html_escape(
                        $donate
                        ->saweria_url
                    ) ?>"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="btn btn-success
                           btn-lg
                           rounded-pill
                           donate-btn">

                        ☕ Traktir via Saweria

                    </a>

                    <?php endif; ?>

                    <!-- BANK INFO -->
                    <?php if(
                        !empty(
                            $donate
                            ->account_number
                        )
                    ): ?>

                    <div class="bank-card">

                        <div class="small
                                    text-muted
                                    mb-1">

                            Transfer Bank

                        </div>

                        <div class="fw-bold">

                            <?= html_escape(
                                $donate
                                ->bank_name
                            ) ?>

                        </div>

                        <div class="mb-1">

                            a.n
                            <?= html_escape(
                                $donate
                                ->account_name
                            ) ?>

                        </div>

                        <div class="bank-number"
                             id="rekeningDonate">

                            <?= html_escape(
                                $donate
                                ->account_number
                            ) ?>

                        </div>

                        <button type="button"
                                class="btn
                                       btn-light
                                       border
                                       btn-sm
                                       rounded-pill
                                       mt-2"
                                onclick="copyRekening()">

                            📋 Salin Rekening

                        </button>

                    </div>

                    <?php endif; ?>

                    <!-- CLOSE -->
                    <button type="button"
                            class="btn btn-link
                                   text-secondary
                                   text-decoration-none"
                            data-bs-dismiss="modal">

                        Nanti saja

                    </button>

                </div>

                <small class="text-muted
                              d-block
                              mt-4">

                    Terima kasih sudah
                    mendukung
                    <?= html_escape(
                        $setting
                        ->site_name
                    ) ?>
                    ❤️

                </small>

            </div>

        </div>

    </div>

</div>

<style>
.donate-float{
    position:fixed;
    right:18px;
    bottom:18px;
    z-index:9999;
    border:none;
    display:flex;
    align-items:center;
    gap:10px;
    padding:12px 18px;
    border-radius:999px;
    background:
    linear-gradient(
    135deg,
    #16a34a,
    #22c55e
    );
    color:#fff;
    box-shadow:
    0 10px 30px
    rgba(34,197,94,.25);
    transition:.25s;
}

.donate-float:hover{
    transform:
    translateY(-3px);
}

.coffee-icon{
    width:38px;
    height:38px;
    border-radius:50%;
    background:
    rgba(255,255,255,.18);
    display:flex;
    align-items:center;
    justify-content:center;
}

.donate-modal{
    border:none;
    border-radius:28px;
}

.donate-close{
    position:absolute;
    top:18px;
    right:18px;
}

.donate-icon{
    width:90px;
    height:90px;
    margin:auto auto 20px;
    border-radius:50%;
    background:#ecfdf5;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:42px;
}

.qris-card{
    background:#f8fafc;
    border:1px solid #e5e7eb;
    border-radius:20px;
    padding:18px;
}

.donate-qris{
    max-width:220px;
    border-radius:18px;
}

.bank-card{
    background:#f8fafc;
    border-radius:18px;
    padding:18px;
    border:1px solid #e5e7eb;
    margin-top:10px;
}

.bank-number{
    font-size:18px;
    font-weight:700;
}

@media(max-width:768px){

    .donate-float{
        right:15px;
        bottom:15px;
        padding:10px 14px;
    }

    .donate-text{
        font-size:13px;
    }

    .modal-dialog{
        margin:15px;
    }

    .donate-modal{
        border-radius:24px;
    }

    .donate-qris{
        max-width:180px;
    }
}
</style>

<script>
function copyRekening(){

    const rekening =
    document
    .getElementById(
        'rekeningDonate'
    )
    .innerText
    .trim();

    navigator.clipboard
    .writeText(
        rekening
    )
    .then(() => {

        showDonateToast(
            'Nomor rekening berhasil disalin 💚'
        );

    })
    .catch(() => {

        showDonateToast(
            'Gagal menyalin rekening'
        );

    });

}

/**
 * TOAST
 */
function showDonateToast(
message
){

    // hapus toast lama
    const oldToast =
    document.querySelector(
        '.donate-toast'
    );

    if(oldToast){
        oldToast.remove();
    }

    // buat toast baru
    const toast =
    document.createElement(
        'div'
    );

    toast.className =
    'donate-toast';

    toast.innerHTML = `
        <div class="toast-check">

            ✓

        </div>

        <span>
            ${message}
        </span>
    `;

    document.body
    .appendChild(
        toast
    );

    // animasi muncul
    setTimeout(() => {

        toast.classList
        .add('show');

    }, 50);

    // auto hide
    setTimeout(() => {

        toast.classList
        .remove('show');

        setTimeout(() => {

            toast.remove();

        }, 300);

    }, 2200);

}

document.addEventListener(
'DOMContentLoaded',
function(){

    const popupKey =
    'nazmu_donate_popup';

    const popupTime =
    localStorage.getItem(
        popupKey
    );

    const now =
    new Date().getTime();

    const intervalDays =
    <?= (int)
    $donate
    ->popup_interval ?>;

    const popupDelay =
    <?= (int)
    $donate
    ->popup_delay ?>;

    const intervalMs =
    intervalDays *
    24 * 60 * 60 * 1000;

    if(
        !popupTime ||
        (now - popupTime)
        > intervalMs
    ){

        setTimeout(function(){

            const modal =
            new bootstrap.Modal(
                document.getElementById(
                    'donateModal'
                )
            );

            modal.show();

            localStorage.setItem(
                popupKey,
                now
            );

        }, popupDelay);

    }

});
</script>

<style>
    /* =======================
DONATE TOAST
======================= */

.donate-toast{
    position: fixed;
    right: 20px;
    bottom: 95px;
    z-index: 999999;

    background: #111827;
    color: #fff;

    padding: 14px 18px;

    border-radius: 18px;

    display: flex;
    align-items: center;
    gap: 12px;

    box-shadow:
    0 15px 40px
    rgba(0,0,0,.18);

    opacity: 0;
    transform:
    translateY(20px);

    transition:
    all .3s ease;
}

.donate-toast.show{
    opacity: 1;
    transform:
    translateY(0);
}

.toast-check{
    width: 32px;
    height: 32px;

    border-radius: 50%;

    background:
    rgba(34,197,94,.20);

    color: #22c55e;

    display:flex;
    align-items:center;
    justify-content:center;

    font-weight:700;
    flex-shrink:0;
}

@media(max-width:768px){

    .donate-toast{
        left:15px;
        right:15px;
        bottom:90px;

        justify-content:center;
    }
}
    </style>
</style>

<script>
function copyRekening(){

    const rekening =
    document
    .getElementById(
        'rekeningDonate'
    )
    .innerText
    .trim();

    navigator.clipboard
    .writeText(
        rekening
    )
    .then(() => {

        showDonateToast(
            'Nomor rekening berhasil disalin 💚'
        );

    })
    .catch(() => {

        showDonateToast(
            'Gagal menyalin rekening'
        );

    });

}

/**
 * TOAST
 */
function showDonateToast(
message
){

    // hapus toast lama
    const oldToast =
    document.querySelector(
        '.donate-toast'
    );

    if(oldToast){
        oldToast.remove();
    }

    // buat toast baru
    const toast =
    document.createElement(
        'div'
    );

    toast.className =
    'donate-toast';

    toast.innerHTML = `
        <div class="toast-check">

            ✓

        </div>

        <span>
            ${message}
        </span>
    `;

    document.body
    .appendChild(
        toast
    );

    // animasi muncul
    setTimeout(() => {

        toast.classList
        .add('show');

    }, 50);

    // auto hide
    setTimeout(() => {

        toast.classList
        .remove('show');

        setTimeout(() => {

            toast.remove();

        }, 300);

    }, 2200);

}

document.addEventListener(
'DOMContentLoaded',
function(){

    const popupKey =
    'nazmu_donate_popup';

    const popupTime =
    localStorage.getItem(
        popupKey
    );

    const now =
    new Date().getTime();

    const intervalDays =
    <?= (int)
    $donate
    ->popup_interval ?>;

    const popupDelay =
    <?= (int)
    $donate
    ->popup_delay ?>;

    const intervalMs =
    intervalDays *
    24 * 60 * 60 * 1000;

    if(
        !popupTime ||
        (now - popupTime)
        > intervalMs
    ){

        setTimeout(function(){

            const modal =
            new bootstrap.Modal(
                document.getElementById(
                    'donateModal'
                )
            );

            modal.show();

            localStorage.setItem(
                popupKey,
                now
            );

        }, popupDelay);

    }

});
</script>


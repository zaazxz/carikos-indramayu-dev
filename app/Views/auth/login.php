<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Carikos-Indramayu</title>

    <!-- Google Font (Source Sans Pro) : Start -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Google Font (Source Sans Pro) : End -->

    <!-- Font Awesome Icons : Start -->
    <link rel="stylesheet" href="<?= base_url('assets') ?>/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Font Awesome Icons : End -->

    <!-- Theme style : Start -->
    <link rel="stylesheet" href="<?= base_url('assets') ?>/dist/css/adminlte.min.css">
    <!-- Theme style : End -->

    <!-- leaflet : Start -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.2/dist/leaflet.css" integrity="sha256-sA+zWATbFveLLNqWO2gtiw3HL/lh1giY/Inf1BJ0z14=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.2/dist/leaflet.js" integrity="sha256-o9N1jGDZrf5tS+Ft4gbIK7mYMipq9lqpVJ91xHSyKhg=" crossorigin=""></script>
    <!-- leaflet : End -->

</head>

<!-- ZARAZ : Start -->
<script data-cfasync="false" nonce="dc6efc07-d433-4a0e-8a17-32babdfc4658">
    try {
        (function(w, d) {
            ! function(j, k, l, m) {
                if (j.zaraz) console.error("zaraz is loaded twice");
                else {
                    j[l] = j[l] || {};
                    j[l].executed = [];
                    j.zaraz = {
                        deferred: [],
                        listeners: []
                    };
                    j.zaraz._v = "5850";
                    j.zaraz._n = "dc6efc07-d433-4a0e-8a17-32babdfc4658";
                    j.zaraz.q = [];
                    j.zaraz._f = function(n) {
                        return async function() {
                            var o = Array.prototype.slice.call(arguments);
                            j.zaraz.q.push({
                                m: n,
                                a: o
                            })
                        }
                    };
                    for (const p of ["track", "set", "debug"]) j.zaraz[p] = j.zaraz._f(p);
                    j.zaraz.init = () => {
                        var q = k.getElementsByTagName(m)[0],
                            r = k.createElement(m),
                            s = k.getElementsByTagName("title")[0];
                        s && (j[l].t = k.getElementsByTagName("title")[0].text);
                        j[l].x = Math.random();
                        j[l].w = j.screen.width;
                        j[l].h = j.screen.height;
                        j[l].j = j.innerHeight;
                        j[l].e = j.innerWidth;
                        j[l].l = j.location.href;
                        j[l].r = k.referrer;
                        j[l].k = j.screen.colorDepth;
                        j[l].n = k.characterSet;
                        j[l].o = (new Date).getTimezoneOffset();
                        if (j.dataLayer)
                            for (const t of Object.entries(Object.entries(dataLayer).reduce(((u, v) => ({
                                    ...u[1],
                                    ...v[1]
                                })), {}))) zaraz.set(t[0], t[1], {
                                scope: "page"
                            });
                        j[l].q = [];
                        for (; j.zaraz.q.length;) {
                            const w = j.zaraz.q.shift();
                            j[l].q.push(w)
                        }
                        r.defer = !0;
                        for (const x of [localStorage, sessionStorage]) Object.keys(x || {}).filter((z => z.startsWith("_zaraz_"))).forEach((y => {
                            try {
                                j[l]["z_" + y.slice(7)] = JSON.parse(x.getItem(y))
                            } catch {
                                j[l]["z_" + y.slice(7)] = x.getItem(y)
                            }
                        }));
                        r.referrerPolicy = "origin";
                        r.src = "/cdn-cgi/zaraz/s.js?z=" + btoa(encodeURIComponent(JSON.stringify(j[l])));
                        q.parentNode.insertBefore(r, q)
                    };
                    ["complete", "interactive"].includes(k.readyState) ? zaraz.init() : j.addEventListener("DOMContentLoaded", zaraz.init)
                }
            }(w, d, "zarazData", "script");
            window.zaraz._p = async bs => new Promise((bt => {
                if (bs) {
                    bs.e && bs.e.forEach((bu => {
                        try {
                            const bv = d.querySelector("script[nonce]"),
                                bw = bv?.nonce || bv?.getAttribute("nonce"),
                                bx = d.createElement("script");
                            bw && (bx.nonce = bw);
                            bx.innerHTML = bu;
                            bx.onload = () => {
                                d.head.removeChild(bx)
                            };
                            d.head.appendChild(bx)
                        } catch (by) {
                            console.error(`Error executing script: ${bu}\n`, by)
                        }
                    }));
                    Promise.allSettled((bs.f || []).map((bz => fetch(bz[0], bz[1]))))
                }
                bt()
            }));
            zaraz._p({
                "e": ["(function(w,d){})(window,document)"]
            });
        })(window, document)
    } catch (e) {
        throw fetch("/cdn-cgi/zaraz/t"), e;
    };
</script>
<!-- ZARAZ : End -->

</head>

<body class="hold-transition register-page">

    <!-- Form Card : Start -->
    <div class="register-box">
        <div class="register-logo">
            <a href="../../index2.html"><b>Login</b></a>
        </div>

        <!-- Form Box : Start -->
        <div class="card">
            <div class="card-body register-card-body">
                <?php $errors = session()->getFlashdata('errors'); ?>
                <?php if (! empty($errors)): ?>
                    <div class="alert alert-danger" role="alert">
                        <ul>
                            <?php foreach ($errors as $error): ?>
                                <li><?= esc($error) ?></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                <?php endif ?>
                <?php
                if (session()->getFlashdata('pesan')) {
                    echo '<div class="alert alert-success" role="alert">';
                    echo session()->getFlashdata('pesan');
                    echo '</div>';
                } ?>
                <p class="login-box-msg">Silahkan Melakukan Login</p>

                <div class="input-group mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>

                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="d-grid gap-2 col-6 mx-auto">
                        <button type="submit" class="btn btn-primary btn-block">Login</button>
                    </div>
                    <!-- /.col -->
                </div>



            </div>
            <!-- /.form-box -->
        </div>
        <!-- Form Box : End -->

    </div>
    <!-- Form Card : End -->

    <!-- jQuery : Start -->
    <script>
        window.setTimeout(function() {
            $(".alert").fadeTo(500.0).slideUp(500, function() {
                $(this).remove();
            });
        }, 3000);
    </script>
    <!-- jQuery : End -->

    <!-- jQuery Plugin : Start -->
    <script src="<?= base_url('assets') ?>/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery Plugin : End -->

    <!-- Bootstrap 4 : Start -->
    <script src="<?= base_url('assets') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap 4 : End -->

    <!-- AdminLTE : Start -->
    <script src="<?= base_url('assets') ?>/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE : End -->
    
</body>

</html>
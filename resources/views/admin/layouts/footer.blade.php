<footer class="footer py-4">
    <div class="container-fluid">
        <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
                <div class="copyright text-center text-sm text-muted text-lg-start"
                    style="color: rgb(0, 0, 0); font-weight: bold;">
                    Developed ©
                    <script>
                        document.write(new Date().getFullYear())
                    </script>,
                    by Diskominfo Pesisir Selatan
                </div>
            </div>
        </div>
    </div>
</footer>

<style>
    .footer {
        border-top: 4px solid #28a745;
        box-shadow: 0 -4px 20px rgba(40, 167, 69, 0.2);
        background: linear-gradient(to right, rgba(40, 167, 69, 0.03), rgba(40, 167, 69, 0.06), rgba(40, 167, 69, 0.03));
        position: relative;
    }
    
    .footer::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(90deg, 
            transparent, 
            #28a745, 
            #20c997,
            #28a745, 
            transparent);
        animation: borderGlow 3s ease-in-out infinite;
    }
    
    @keyframes borderGlow {
        0%, 100% {
            opacity: 1;
        }
        50% {
            opacity: 0.7;
        }
    }
    
    .footer .copyright {
        color: #28a745 !important;
        font-weight: bold;
        text-shadow: 0 0 15px rgba(40, 167, 69, 0.4);
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
    }
    
    .footer .copyright:hover {
        text-shadow: 0 0 25px rgba(40, 167, 69, 0.6);
        transform: translateY(-2px);
    }
</style>
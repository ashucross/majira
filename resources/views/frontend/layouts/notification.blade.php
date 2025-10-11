<style>
    .alert-box {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%) scale(0.8);
    padding: 20px 40px;
    border-radius: 15px;
    font-size: 18px;
    color: #fff;
    text-align: center;
    z-index: 9999;
    opacity: 0;
    animation: fadeInOut 20s ease-in-out forwards;
    display: flex;
    align-items: center;
    gap: 10px;
    backdrop-filter: blur(10px);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.25);
    width: 500px;
}

.alert-box.success {
    background: rgb(13 108 53 / 85%);
}

.alert-box.error {
    background: rgba(148, 43, 31, 0.85);
}

.alert-icon {
    font-size: 24px;
}

.close-btn {
    background: rgba(255, 255, 255, 0.2);
    border: none;
    color: white;
    font-size: 20px;
    margin-left: 15px;
    cursor: pointer;
    border-radius: 50%;
    width: 30px;
    height: 30px;
    transition: 0.3s;
}

.close-btn:hover {
    background: rgba(255, 255, 255, 0.4);
}

@keyframes fadeInOut {
    0% {
        opacity: 0;
        transform: translate(-50%, -50%) scale(0.8);
    }
    10%, 90% {
        opacity: 1;
        transform: translate(-50%, -50%) scale(1);
    }
    100% {
        opacity: 0;
        transform: translate(-50%, -50%) scale(0.8);
    }
}
    </style>
@if(session('success'))
    <div class="alert-box success" id="flashMessage"> 
        <span>{{ session('success') }}</span>
        <button class="close-btn" onclick="closeAlert()">×</button>
    </div>
@endif

@if(session('error'))
    <div class="alert-box error" id="flashMessage"> 
        <span>{{ session('error') }}</span>
        <button class="close-btn" onclick="closeAlert()">×</button>
    </div>
@endif
<script>
    function closeAlert() {
        const alert = document.getElementById('flashMessage');
        if (alert) {
            alert.style.transition = "opacity 0.4s ease";
            alert.style.opacity = 0;
            setTimeout(() => alert.remove(), 500);
        }
    }
</script>

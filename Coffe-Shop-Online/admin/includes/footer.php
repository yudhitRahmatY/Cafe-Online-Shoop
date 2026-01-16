<div class="footer">© <?= date('Y') ?> Home Coffee | MR Ryuzz</div>
</main>
</div>

<script>
    // tombol sidebar untuk HP
    (function () {
        const sidebar = document.querySelector('.sidebar');
        const btn = document.createElement('button');
        btn.innerText = '☰';
        btn.style.position = 'fixed';
        btn.style.left = '12px';
        btn.style.top = '12px';
        btn.style.zIndex = 9999;
        btn.style.background = 'var(--accent)';
        btn.style.border = '0';
        btn.style.padding = '8px 10px';
        btn.style.borderRadius = '8px';
        btn.style.cursor = 'pointer';

        btn.addEventListener('click', () => {
            if (sidebar.style.display === 'block') {
                sidebar.style.display = 'none';
            } else {
                sidebar.style.display = 'block';
                sidebar.style.position = 'fixed';
                sidebar.style.left = '12px';
                sidebar.style.top = '60px';
                sidebar.style.zIndex = 9998;
            }
        });
        document.body.appendChild(btn);
    })();
</script>

</body>

</html>
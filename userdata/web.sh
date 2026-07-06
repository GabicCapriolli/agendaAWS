#!/bin/bash

# Atualiza o sistema
dnf update -y

# Instala Apache, PHP e extensão MySQL
dnf install -y httpd php php-mysqlnd

# Inicia o Apache
systemctl enable httpd
systemctl start httpd

# Permissões
chown -R apache:apache /var/www/html
chmod -R 755 /var/www/html

# Página temporária para teste
cat > /var/www/html/index.php << 'EOF'
<?php
echo "<h1>Servidor ativo!</h1>";
echo "<p>Hostname: " . gethostname() . "</p>";
phpinfo();
?>
EOF
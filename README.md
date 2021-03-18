# Документация фреймворка ZZILA
## 1. Начало работы
### 1.1 Скачать и установить (для Windows):
1. WSL2 [docs.microsoft.com](https://docs.microsoft.com/ru-ru/windows/wsl/install-win10 "Установка WSL2")
2. Docker [docker.com](https://www.docker.com/ "Установка Docker")
3. (необязательно) Любую IDE (например [VSCode](https://code.visualstudio.com/ "VSC"))

## 2. Подготовка
### 2.1 Windows
#### 2.1.1 Установить фреймворк
> git clone https://github.com/refunct/zzila-framework.git .

#### 2.1.2 Подготовка локальной машины
1. Откройте файл hosts, который лежит по адресу:
    > C:\Windows\System32\drivers\etc
2. Откройте его любым текстовым редактором и в конец файла впишите:
    > 127.0.0.1 zzila.loc

### 3. Работа над проектом
#### 3.1 Управление проектом
1. Запустите приложение Docker
2. Для запуска контейнера введите команду в консоль:
    > docker-compose up -d
    
    Если в ходе работе вы обновили конфигурацию Docker, то
    
    > docker-compose up -d --build
3. После установки и запуска всех компонентов можно будет открыть сайт:
    > zzila.loc
4. Открыть phpMyAdmin:
    > http://127.0.0.1:8080

    Данные для входа:
    > Сервер: mysql
    
    > Пользователь: root

    > Пароль: secret
5. Остановить Docker:
    > docker-compose down
    
    Или остановить все
    > docker stop $(docker ps -a -q)
### 4. Сеть Docker
1. nginx
    > ipv4: 192.162.201.2

    > ipv6: 2001:3984:3989::20

    > port: 80
2. php
    > ipv4: 192.162.201.3

    > ipv6: 2001:3984:3989::30

    > port: 9000
3. mysql
    > ipv4: 192.162.201.4

    > ipv6: 2001:3984:3989::40

    > port: 3306
4. phpmyadmin
    > ipv4: 192.162.201.5

    > ipv6: 2001:3984:3989::50

    > port: 8080

### 5. Установить на удаленный сервер
1. Установите фреймворк (п 2.1)
2. Создайте репозиторий на GitHub
3. Выполните команды 
    
    > git init
    
    > git add .
    
    > git commit -m "Init commit"
    
    > git branch -M main
   
    > git remote add origin https://github.com/{ВАШ ЛОГИН}/{ИМЯ ВАШЕГО РЕПОЗИТОРИЯ}.git
    
    > git push -u origin main

4. Подключитесь по SSH к вашему хостингу и перейдите в папку с сайтом
5. Выполните команды
    > git clone https://github.com/{ВАШ ЛОГИН}/{ИМЯ ВАШЕГО РЕПОЗИТОРИЯ}.git .
    
    > git pull
### 6. Ошибки
1. При запуске докера появляется ошибка
    
    > ERROR: Pool overlaps with other one on this address space

    Очистите сети командой
    
    > docker network prune
### 7. Ссылки
* [Официальный сайт](https://zzila.com/ "zzila.com")
* [Документация](https://zzila.com/work/framework "Документация")
* [YouTube канал](https://www.youtube.com/channel/UC3Q_N1wUw1suldnpFJgQzUQ "YouTube refunct")
* [Telegram канал](https://zzila.com/telegram-channel "Telegram refunct_blog")
* [Поддержать](https://zzila.com/support "Поддержать")
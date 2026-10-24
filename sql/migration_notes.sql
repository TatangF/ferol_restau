-- =====================================================================
-- ferol_restau / food-order — Notes et scripts de migration SQL
-- =====================================================================
-- IMPORTANT : je n'ai pas reçu de dump de la base "food-order" (export .sql
-- ou sortie de SHOW CREATE TABLE). Les colonnes ci-dessous sont donc DEDUITES
-- de leur usage dans le code PHP fourni (categories.php, menu.php, index.php,
-- login.php, register.php, message.php). Avant d'exécuter quoi que ce soit :
--
--   1. Faites un export complet de la base :
--        mysqldump -u root food-order > backup_avant_migration.sql
--   2. Comparez la structure réelle de vos tables avec les hypothèses
--      ci-dessous (phpMyAdmin > onglet "Structure", ou SHOW CREATE TABLE nom_table;)
--   3. Adaptez les types/longueurs si besoin avant d'exécuter.
--
-- Colonnes utilisées dans le code (confirmées) :
--   tbl_category : id, title, image_name, active
--   tbl_food     : id, title, price, image_name, active, featured, (category_id : utilisé
--                  par le nouveau filtre menu.php, à confirmer/ajouter si absent)
--   tbl_users    : id, name, email, add1, city, phone, username, password
--   message      : name, phone, subject, message, message_status, date
--
-- Le code utilise "tbl_users" (pas "users" comme indiqué dans le README d'origine) :
-- c'est cohérent dans tout le projet, donc PAS de changement nécessaire, seule
-- la documentation était trompeuse.
-- =====================================================================


-- 1) SECURITE : le mot de passe passe de MD5 (32 caractères fixes) à password_hash()
--    (algorithme bcrypt, jusqu'à 255 caractères). Aucune donnée n'est perdue :
--    login.php migre automatiquement chaque mot de passe MD5 vers bcrypt à la
--    prochaine connexion réussie de l'utilisateur concerné (voir login.php).
ALTER TABLE tbl_users
    MODIFY COLUMN password VARCHAR(255) NOT NULL;

-- 2) INTEGRITE : un identifiant doit être unique pour que la vérification de
--    doublon dans register.php soit fiable même en cas de double soumission
--    simultanée (actuellement seule la logique applicative l'empêche).
ALTER TABLE tbl_users
    ADD UNIQUE KEY uq_tbl_users_username (username);

-- 3) PERFORMANCE : les pages catégories/menu filtrent systématiquement sur
--    "active", et le nouveau filtre menu.php filtre sur category_id.
ALTER TABLE tbl_category
    ADD INDEX idx_tbl_category_active (active);

ALTER TABLE tbl_food
    ADD INDEX idx_tbl_food_active_featured (active, featured);

-- 4) RELATION : si tbl_food ne possède pas encore de colonne category_id reliant
--    chaque plat à sa catégorie (nécessaire pour le filtre "Explore Category"),
--    l'ajouter avec une vraie clé étrangère. À N'EXECUTER QUE SI cette colonne
--    n'existe pas déjà sous un autre nom (vérifiez d'abord !).
-- ALTER TABLE tbl_food
--     ADD COLUMN category_id INT UNSIGNED NULL AFTER title,
--     ADD CONSTRAINT fk_tbl_food_category
--         FOREIGN KEY (category_id) REFERENCES tbl_category(id)
--         ON DELETE SET NULL ON UPDATE CASCADE;

-- 5) SUIVI DES MESSAGES DE CONTACT : la table "message" n'a pas de clé primaire
--    visible dans le code (jamais de mysqli_insert_id() utilisé). Si ce n'est
--    pas déjà le cas, ajoutez un identifiant auto-incrémenté.
-- ALTER TABLE message
--     ADD COLUMN id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY FIRST;

-- =====================================================================
-- Pour aller plus loin : envoyez-moi le résultat de
--   SHOW CREATE TABLE tbl_category;
--   SHOW CREATE TABLE tbl_food;
--   SHOW CREATE TABLE tbl_users;
--   SHOW CREATE TABLE message;
-- et je vous fournirai des ALTER TABLE exacts (types, longueurs, contraintes
-- NOT NULL) au lieu de ces hypothèses.
-- =====================================================================

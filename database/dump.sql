CREATE TABLE `tasks`
(
    `id`       BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(100)        NOT NULL,
    `email`    VARCHAR(100)        NOT NULL,
    `text`     LONGTEXT            NOT NULL,
    PRIMARY KEY (`id`)
);

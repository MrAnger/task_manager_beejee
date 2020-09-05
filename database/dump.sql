CREATE TABLE `tasks`
(
    `id`                  BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    `username`            VARCHAR(100)        NOT NULL,
    `email`               VARCHAR(100)        NOT NULL,
    `text`                LONGTEXT            NOT NULL,
    `is_completed`        TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
    `is_updated_by_admin` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
    PRIMARY KEY (`id`)
);

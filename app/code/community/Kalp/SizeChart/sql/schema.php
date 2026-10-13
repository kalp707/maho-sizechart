<?php

/**
 * SPDX-FileCopyrightText: 2026 Kalp SizeChart Contributors
 * SPDX-License-Identifier: OSL-3.0
 * @package Kalp_SizeChart
 */

declare(strict_types=1);

use Doctrine\DBAL\Schema\DefaultExpression\CurrentTimestamp;
use Doctrine\DBAL\Schema\PrimaryKeyConstraint;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Types;

return function (Schema $schema): void {
    $chart = $schema->createTable('sizechart_chart');
    $chart->addColumn('chart_id', Types::INTEGER, ['unsigned' => true, 'autoincrement' => true]);
    $chart->addColumn('name', Types::STRING, ['length' => 255]);
    $chart->addColumn('identifier', Types::STRING, ['length' => 64, 'notnull' => false]);
    $chart->addColumn('status', Types::SMALLINT, ['unsigned' => true, 'default' => 1]);
    $chart->addColumn('content', Types::TEXT, ['length' => 16777215, 'notnull' => false]);
    $chart->addColumn('created_at', Types::DATETIME_MUTABLE, ['default' => new CurrentTimestamp()]);
    $chart->addColumn('updated_at', Types::DATETIME_MUTABLE, ['default' => new CurrentTimestamp()]);
    $chart->addPrimaryKeyConstraint(
        PrimaryKeyConstraint::editor()->setUnquotedColumnNames('chart_id')->create(),
    );
    $chart->addUniqueIndex(['identifier']);
    $chart->addIndex(['status']);
    $chart->setComment('Product size charts');
};

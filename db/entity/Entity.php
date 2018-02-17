<?php

namespace db\entity;


interface Entity
{
    const STATUS_DELETED = 0;
    const STATUS_APPROVED = 1;
    const STATUS_MODERATION = 2;
}

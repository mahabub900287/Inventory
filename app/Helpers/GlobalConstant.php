<?php

namespace App\Helpers;

class GlobalConstant
{
    // Status
    public const STATUS_ACTIVE = 'active';

    public const STATUS_INACTIVE = 'inactive';

    public const STATUS_PENDING = 'pending';

    public const STATUS_DRAFT = 'draft';

    public const STATUS_PUBLISHED = 'published';

    public const STATUS_CANCELED = 'canceled';

    public const STATUS_PAID = 'paid';

    public const STATUS_UNPAID = 'unpaid';

    public const STATUS_REJECTED = 'rejected';

    public const STATUS_CONFIRMED = 'confirmed';

    public const STATUS_ACCEPTED = 'accepted';

    public const STATUS_ENROLLED = 'enrolled';

    public const STATUS_POSTPOND = 'postpond';

    // Default
    public const DEFAULT_PER_PAGE = 12;

    public const DEFAULT_RECENT_LIMIT = 5;

    public const DEFAULT_THUMB_WIDTH = 300;

    public const DEFAULT_THUMB_HEIGHT = 170;

    public const DEFAULT_QR_CODE_SIZE = 300;
}

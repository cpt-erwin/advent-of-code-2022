<?php

declare(strict_types=1);

namespace App;

class Interval
{
    /** @var int[] */
    protected array $values;

    public function __construct(
        int $start,
        int $end
    )
    {
        $values = [];
        for ($i = 0; $i <= ($end - $start); $i++) {
            $values[] = $i + $start;
        }

        $this->values = $values;
    }

    /**
     * @param Interval $firstInterval
     * @param Interval $secondInterval
     *
     * @return bool
     */
    private static function checkIfDuplicated(Interval $firstInterval, Interval $secondInterval): bool
    {
        $intervalsDiff = array_merge(
            array_diff(
                $firstInterval->getValues(),
                $secondInterval->getValues()
            ), array_diff(
                $secondInterval->getValues(),
                $firstInterval->getValues(),
            )
        );

        return count($intervalsDiff) === 0;
    }

    /**
     * @param Interval $firstInterval
     * @param Interval $secondInterval
     *
     * @return int
     * Returns -1 when the second interval is fully contained in the first interval,
     * 0 when none of the intervals is fully contained in the other,
     * 1 when the first interval is fully contained in the second interval,
     * 2 when both intervals are exactly the same.
     */
    public static function fullyContained(Interval $firstInterval, Interval $secondInterval): int
    {
        if (self::checkIfDuplicated(
            $firstInterval,
            $secondInterval
        )) {
            return 2;
        }

        $firstInSecond = count(
                array_intersect(
                    $firstInterval->getValues(),
                    $secondInterval->getValues()
                )
            ) === count($firstInterval->getValues());

        $secondInFirst = count(
                array_intersect(
                    $secondInterval->getValues(),
                    $firstInterval->getValues()
                )
            ) === count($secondInterval->getValues());

        return (int)$firstInSecond - (int)$secondInFirst;
    }

    /**
     * @param Interval $firstInterval
     * @param Interval $secondInterval
     *
     * @return bool
     */
    public static function intersects(Interval $firstInterval, Interval $secondInterval): bool
    {
        if (self::checkIfDuplicated(
            $firstInterval,
            $secondInterval
        )) {
            return true;
        }

        $intersections = array_intersect(
            $firstInterval->getValues(),
            $secondInterval->getValues()
        );

        return count($intersections) > 0;
    }

    /**
     * @return int[]
     */
    public function getValues(): array
    {
        return $this->values;
    }

    /**
     * @return int
     */
    public function getSize(): int
    {
        return count($this->values);
    }
}
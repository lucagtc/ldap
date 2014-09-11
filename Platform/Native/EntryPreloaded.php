<?php

/*
 * This file is part of the 81square/tiesa-ldap package
 *
 * (c) 81 Square <info@81square.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Toyota\Component\Ldap\Platform\Native;

use Toyota\Component\Ldap\API\EntryInterface;

/**
 * Implementation of the entry interface for php ldap extension
 *
 * @author Maarten van Zanten <info@81square.nl>
 */
class EntryPreloaded implements EntryInterface
{

    protected $entry = null;

    /**
     * Constructor
     * 
     * @param array $entry Entry data
     */
    public function __construct(array $entry)
    {
        $this->entry = $entry;
    }

    /**
     * Retrieves entry distinguished name
     *
     * @return string Distinguished name
     */
    public function getDn()
    {
        return $this->entry['dn'];
    }

    /**
     * Retrieves entry attributes
     *
     * @return array(attribute => array(values))
     */
    public function getAttributes()
    {
        $data = $this->entry;

        $result = array();

        for ($i = 0; $i < $data['count']; $i++) {
            $key = $data[$i];
            $result[$key] = array();
            for ($j = 0; $j < $data[$key]['count']; $j++) {
                $result[$key][] = $data[$key][$j];
            }
        }

        return $result;
    }

}

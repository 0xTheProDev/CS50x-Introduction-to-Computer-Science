/**
 * helpers.c
 *
 * Computer Science 50
 * Problem Set 3
 *
 * Helper functions for Problem Set 3.
 */
       
#include <cs50.h>

#include "helpers.h"

/**
 * Binary Search O(N log N)
*/
bool bin(int key, int arr[], int min, int max)
{
    if(min > max)
        return false;
    else
    {
        int i = (min + max) / 2;
        if(arr[i] == key)
            return true;
        else if(arr[i] < key)
            return bin(key, arr, i + 1, max);
        else
            return bin(key, arr, min, i - 1);
    }
}

/**
 * Returns true if value is in array of n values, else false.
 */
bool search(int value, int values[], int n)
{
    // TODO: implement a searching algorithm
    return bin(value, values, 0, n);
}

/**
 * Sorts array of n values.
 */
void sort(int values[], int n)
{
    // TODO: implement an O(n^2) sorting algorithm
    int i, j;
    for(i = 0; i < n; i++)
    {
        for(j = 0; j < i; j++)
            if(values[i] < values[j]) 
                values[i] ^= values[j] ^= values[i] ^= values[j];
    }
    return;
}
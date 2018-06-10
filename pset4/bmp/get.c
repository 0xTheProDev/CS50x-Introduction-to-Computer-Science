#include <stdio.h>
#include "bmp.h"

int main(void)
{
    RGBTRIPLE *q;
    printf("%lu %lu %lu\n", sizeof(BITMAPFILEHEADER), sizeof(BITMAPINFOHEADER), sizeof(q));
    return 0;
}
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

using System.Drawing;

namespace IAGenetic_DrawingMuse.Genetic
{
    class PopulationGoal : Population
    {
        private Dictionary<string, IndividualColor> palette;

        public PopulationGoal(Bitmap _img)
        {
            width = _img.Width;
            height = _img.Height;
            individuals = new IndividualColor[width * height];
            palette = new Dictionary<string, IndividualColor>();

            InitPopulation(_img);
        }

        private void InitPopulation(Bitmap _img)
        {
            int iIndividual;
            string keyIndividual;

            for (int iLig = 0; iLig < _img.Height; iLig++)
            {
                for (int iCol = 0; iCol < _img.Width; iCol++)
                {
                    iIndividual = iLig * width + iCol;
                    Color pixelColor = _img.GetPixel(iCol, iLig);

                    // Save all color pixels
                    IndividualColor colorIndividual = new IndividualColor(pixelColor);
                    individuals[iIndividual] = colorIndividual;

                    // Save the color palette
                    keyIndividual = colorIndividual.GetARGBCode();
                    if (!palette.ContainsKey(keyIndividual))
                    {
                        palette.Add(keyIndividual, colorIndividual);
                    }
                }
            }
        }

        public Dictionary<string, IndividualColor> GetPalette()
        {
            return palette;
        }
    }
}
